<?php

    class ParsingText {

        private $listText = NULL;

        public function __construct($localFile) {

            $this->setListParse($localFile);

        }

        public function setListParse($wordsFile) {

            if (empty($wordsFile) || !is_array($wordsFile)) {

                $this->returnError('Invalid local file');

            }

            $this->listText = $wordsFile;

        }

        public function parseText($text_p, $opt_args = '') {

            if (!isset($this->listText) || empty($this->listText) || !is_array($this->listText)) {

                $this->returnError('Invalid content file');

            }

            $text_parsed = "";

            $wash_t = $this->cleanText($text_p);

            preg_match_all('/{(.*?)?}/', $text_p, $matches);
            if (!empty($matches[1])) {

                if (count($matches[1]) == 1) {

                    $s_word = $this->cleanText($matches[1][0]);
                    if (!empty($s_word))
                        $text_parsed = (isset($this->listText[$s_word])) ? str_replace('{'.$s_word.'}', $this->listText[$s_word], $text_p) : $wash_t;

                } else {

                    $text_parsed = $wash_t;

                    foreach ($matches[1] as $dwords) {

                        $s_word = $this->cleanText($dwords);

                        if (!empty($s_word))
                            $text_parsed = (isset($this->listText[$s_word])) ? str_replace('{'.$s_word.'}', $this->listText[$s_word], $text_parsed) : $text_parsed;

                    }

                }

            } else {

                $text_parsed = $wash_t;

            }

            if (isset($opt_args) && !empty($opt_args))
                $text_parsed = (is_array($opt_args)) ? vsprintf($text_parsed, $opt_args) : sprintf($text_parsed, $opt_args);

            return $text_parsed;

        }

        private function cleanText($text) {

            preg_match_all('/<([^>]*)>/', $text, $results);
            if (empty($results[1]))
                $text = preg_replace('/\s+/', ' ', $text);

            return trim($text);

        }

        private function cleanArgs($list) {

            return array_map('trim', $list);

        }

        private function returnError($errorMessage) {

            throw new Exception($errorMessage);

        }

    }
