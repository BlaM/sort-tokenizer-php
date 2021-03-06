<?php
/*
MIT License

Copyright (c) 2017 Dominik Deobald

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

class SortTokenizer {
    public $ignoreCase = true;
    public $throwOnUnsupportedKey = false;

    public $keys = array();

    function parse($sort) {
        $sort = explode(',', $sort);

        $res = array();

        foreach ($sort as $v) {
            $v = trim($v);
            if ($this->ignoreCase) { $v = strtolower($v); }

            $order = (substr($v, 0, 1) == '-') ? -1 : 1;
            $v = trim($v, '-');

            if (empty($this->keys) || ($this->keys[$v] && in_array($order, $this->keys[$v]))) {
                $res[] = array($v, $order);
            } elseif ($this->throwOnUnsupportedKey) {
                throw new Exception('unsupported key');
            }
        }

        return $res;
    }
}
