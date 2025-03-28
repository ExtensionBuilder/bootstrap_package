<?php declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * ExternalMediaUtility
 */
class ExternalMediaUtility
{
    /**
     * @var array Provider that can be handled, the provider is equal the hostname and needs a process function
     */
    protected array $mediaProvider = [
        'youtube',
        'youtu',
        'vimeo',
    ];

    /**
     * Get the embed code for the given url if possible
     * and add a css class on the iframe
     */
    public function getEmbedCode(?string $url, ?string $class, ?string $title = null): ?string
    {
        if ($url === null || $url === '') {
            return null;
        }

        // Prepare url
        $url = $this->setProtocolToHttps($url);
        // Get method
        $method = $this->getMethod($url);
        if ($method !== null) {
            $embedUrl = $this->{$method}($url);
            if ($embedUrl !== null) {
                $attributes = [
                    'src' => $embedUrl,
                    'frameborder' => '0',
                ];
                if ($title !== null && trim($title) !== '') {
                    $attributes['title'] = trim($title);
                }
                if ($class !== null && trim($class) !== '') {
                    $attributes['class'] = trim($class);
                }
                return '<iframe ' . GeneralUtility::implodeAttributes($attributes, true) . ' allowfullscreen></iframe>';
            }
        }
        return null;
    }

    /**
     * Resolves if possible a method name to process the url
     */
    protected function getMethod(string $url): ?string
    {
        $urlInformation = @parse_url($url);
        if (is_array($urlInformation) && isset($urlInformation['host'])) {
            $hostName = GeneralUtility::trimExplode('.', $urlInformation['host'], true);
            foreach ($this->mediaProvider as $provider) {
                $functionName = 'process' . ucfirst($provider);
                if (in_array($provider, $hostName, true) && is_callable([$this, $functionName])) {
                    return $functionName;
                }
            }
        }
        return null;
    }

    /**
     * Processes YouTube url
     */
    protected function processYoutube(string $url): ?string
    {
        $firstMatches = [];
        $pattern = '%^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=))([^"&?/ ]{11})(?:.+)?$%xs';
        preg_match($pattern, $url, $firstMatches);
        if (isset($firstMatches[1])) {
            $toEmbed = $firstMatches[1];
            $patternForAdditionalParams = '%^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=))(?:[^"&?\/ ]{11})(.+)?(?:.+)?$%xs';
            $secondMatches = [];
            preg_match($patternForAdditionalParams, $url, $secondMatches);
            if (isset($secondMatches[1])) {
                $toEmbed .= '?' . substr($secondMatches[1], 1);
            }
            return 'https://www.youtube-nocookie.com/embed/' . $toEmbed;
        }
        return null;
    }

    /**
     * Process YouTube short url
     */
    protected function processYoutu(string $url): ?string
    {
        return $this->processYoutube($url);
    }

    /**
     * Processes Vimeo url
     */
    protected function processVimeo(string $url): ?string
    {
        $matches = [];
        if ((bool) preg_match('/[\\/#](\\d+)$/', $url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }
        return null;
    }

    /**
     * Change every protocol to https and add it if missing
     */
    protected function setProtocolToHttps(string $url): string
    {
        $processUrl = trim($url);
        if (strpos($url, 'http://') === 0) {
            $processUrl = substr($processUrl, 7);
        } elseif (strpos($processUrl, 'https://') === 0) {
            $processUrl = substr($processUrl, 8);
        } elseif (strpos($processUrl, '//') === 0) {
            $processUrl = substr($processUrl, 2);
        }
        return 'https://' . $processUrl;
    }
}
