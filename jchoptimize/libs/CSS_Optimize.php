<?php

namespace JchOptimize;

/**
 * Class Minify_CSS
 * @package Minify
 */

/**
 * Compress CSS
 *
 * This is a heavy regex-based removal of whitespace, unnecessary
 * comments and tokens, and some CSS value minimization, where practical.
 * Many steps have been taken to avoid breaking comment-based hacks,
 * including the ie5/mac filter (and its inversion), but expect tricky
 * hacks involving comment tokens in 'content' value strings to break
 * minimization badly. A test suite is available.
 *
 * @package Minify
 * @author Stephen Clay <steve@mrclay.org>
 * @author http://code.google.com/u/1stvamp/ (Issue 64 patch)
 */
class CSS_Optimize extends Optimize
{

        /**
         * Minify a CSS string
         *
         * @param string $css
         *
         * @param array $options (currently ignored)
         *
         * @return string
         */
        public static function optimize($css, $options = array())
        {
                $obj = new CSS_Optimize($options);
                return $obj->_optimize($css);
        }

        /**
         * @var array options
         */
        protected $_options = null;

        /**
         * @var bool Are we "in" a hack?
         *
         * I.e. are some browsers targetted until the next comment?
         */
        protected $_inHack = false;

        /**
         * Constructor
         *
         * @param array $options (currently ignored)
         *
         * @return null
         */
        private function __construct($options)
        {
                $this->_options = $options;
        }

        /**
         * Minify a CSS string
         *
         * @param string $css
         *
         * @return string
         */
        private function _optimize($css)
        {
                $s1 = self::DOUBLE_QUOTE_STRING;
                $s2 = self::SINGLE_QUOTE_STRING;
                $u  = '(?<=url)\([^)]*+\)';

                //JCH_DEBUG ? \JchPlatformProfiler::mark('beforeMinifyCss plgSystem (JCH Optimize)') : null;
                // Remove all comments

                $css = preg_replace("#(?>/?[^/\"'(]*+(?:$s1|$s2|$u|[\"'(])?)*?\K(?>/\*(?:\*?[^*]*+)*?\*/|//[^\r\n]*+|$)#s", '', $css);

                //JCH_DEBUG ? \JchPlatformProfiler::mark('afterRemoveComments plgSystem (JCH Optimize)') : null;
                // remove ws around , ; : { } in CSS Declarations and media queries
                $css = preg_replace(
                        "#(?>(?:[{};]|^)[^{}@;]*+{|(?:(?<![,;:{}])\s++(?![,;:{}]))?[^\s{};\"'(]*+(?:$s1|$s2|$u|[\"'({};])?)+?\K"
                        . "(?:\s++(?=[,;:{}])|(?<=[,;:{}])\s++|\K$)#s", '',
                        $css
                );

                //remove ws around , + > ~ { } in selectors
                $css = preg_replace(
                        "#(?>(?:(?<![,+>~{}])\s++(?![,+>~{}]))?[^\s{\"'(]*+(?:{[^{}]++}|{|$s1|$s2|$u|[\"'(])?)*?\K"
                        . "(?:\s++(?=[,+>~{}])|(?<=[,+>~{};])\s++|$\K)#s", '', $css
                );

                //JCH_DEBUG ? \JchPlatformProfiler::mark('afterRemoveWsAroundBrackets plgSystem (JCH Optimize)') : null;
                //remove last ; in block
                $css = preg_replace("#(?>(?:;(?!}))?[^;\"'(]*+(?:$s1|$s2|$u|[\"'(])?)*?(?:\K;(?=})|$\K)#s", '', $css);

                //JCH_DEBUG ? \JchPlatformProfiler::mark('afterRemoveLastSemicolon plgSystem (JCH Optimize)') : null;
                // remove ws inside urls
                $css = preg_replace("#(?>\(?[^\"'(]*+(?:$s1|$s2|[\"'])?)*?(?:(?<=\burl)\(\K\s++|\G"
                        . "(?(?=[\"'])['\"][^'\"]++['\"]|[^\s]++)\K\s++(?=\))|$\K)#s", '', $css);

                //JCH_DEBUG ? \JchPlatformProfiler::mark('afterRemoveWsAroundUrls plgSystem (JCH Optimize)') : null;
                // minimize hex colors
               
                $css = preg_replace("/(?>\#?[^\#\"'(]*+(?:$s1|$s2|$u|[\"'(])?)*?(?:(?<!=)\#\K"
                        . "([a-f\d])\g{1}([a-f\d])\g{2}([a-f\d])\g{3}|$\K)/is", '$1$2$3', $css);

                //JCH_DEBUG ? \JchPlatformProfiler::mark('afterMinimizeHexColors plgSystem (JCH Optimize)') : null;
                // reduce remaining ws to single space
                $css = preg_replace("#(?>[^\s'\"(]*+(?:$s1|$s2|$u|[\"'(]|\s(?!\s))?)*?\K(?:\s\s++|$)#s", ' ', $css);

                //JCH_DEBUG ? \JchPlatformProfiler::mark('afterReduceWsToSingleSpace plgSystem (JCH Optimize)') : null;
                return trim($css);
        }

}
