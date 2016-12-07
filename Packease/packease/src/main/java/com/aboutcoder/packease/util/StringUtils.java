// This Class depends on series of open source project such as
// "greenrobot/greenrobot-common" and "Trinea/android-common"
/*
 * Copyright (C) 2015 Jerome Chan, AboutCoder.COM (http://aboutcoder.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
package com.aboutcoder.packease.util;

import java.io.UnsupportedEncodingException;
import java.math.BigInteger;
import java.net.URLDecoder;
import java.net.URLEncoder;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Copyright © 2011-2015 AboutCoder.COM. All rights reserved.
 *
 * @author jeromechan
 * @datetime 6/2/15 6:12 PM
 * @description
 * @link https://github.com/Trinea/android-common
 * @link https://github.com/greenrobot/greenrobot-common
 */
public class StringUtils {
    /**
     * is null or its length is 0 or it is made by space
     *
     * <pre>
     * isBlank(null) = true;
     * isBlank(&quot;&quot;) = true;
     * isBlank(&quot;  &quot;) = true;
     * isBlank(&quot;a&quot;) = false;
     * isBlank(&quot;a &quot;) = false;
     * isBlank(&quot; a&quot;) = false;
     * isBlank(&quot;a b&quot;) = false;
     * </pre>
     *
     * @param str
     * @return if string is null or its size is 0 or it is made by space, return true, else return false.
     */
    public static boolean isBlank(String str) {
        return (str == null || str.trim().length() == 0);
    }

    /**
     * is null or its length is 0
     *
     * <pre>
     * isEmpty(null) = true;
     * isEmpty(&quot;&quot;) = true;
     * isEmpty(&quot;  &quot;) = false;
     * </pre>
     *
     * @param str
     * @return if string is null or its size is 0, return true, else return false.
     */
    public static boolean isEmpty(CharSequence str) {
        return (str == null || str.length() == 0);
    }

    /**
     * get length of CharSequence
     *
     * <pre>
     * length(null) = 0;
     * length(\"\") = 0;
     * length(\"abc\") = 3;
     * </pre>
     *
     * @param str
     * @return if str is null or empty, return 0, else return {@link CharSequence#length()}.
     */
    public static int length(CharSequence str) {
        return str == null ? 0 : str.length();
    }

    /**
     * null Object to empty string
     *
     * <pre>
     * nullStrToEmpty(null) = &quot;&quot;;
     * nullStrToEmpty(&quot;&quot;) = &quot;&quot;;
     * nullStrToEmpty(&quot;aa&quot;) = &quot;aa&quot;;
     * </pre>
     *
     * @param str
     * @return
     */
    public static String nullStrToEmpty(Object str) {
        return (str == null ? "" : (str instanceof String ? (String)str : str.toString()));
    }

    /**
     * capitalize first letter
     *
     * <pre>
     * capitalizeFirstLetter(null)     =   null;
     * capitalizeFirstLetter("")       =   "";
     * capitalizeFirstLetter("2ab")    =   "2ab"
     * capitalizeFirstLetter("a")      =   "A"
     * capitalizeFirstLetter("ab")     =   "Ab"
     * capitalizeFirstLetter("Abc")    =   "Abc"
     * </pre>
     *
     * @param str
     * @return
     */
    public static String capitalizeFirstLetter(String str) {
        if (isEmpty(str)) {
            return str;
        }

        char c = str.charAt(0);
        return (!Character.isLetter(c) || Character.isUpperCase(c)) ? str : new StringBuilder(str.length())
                .append(Character.toUpperCase(c)).append(str.substring(1)).toString();
    }

    /**
     * encoded in utf-8
     *
     * <pre>
     * utf8Encode(null)        =   null
     * utf8Encode("")          =   "";
     * utf8Encode("aa")        =   "aa";
     * utf8Encode("啊啊啊")   = "%E5%95%8A%E5%95%8A%E5%95%8A";
     * </pre>
     *
     * @param str
     * @return
     * @throws UnsupportedEncodingException if an error occurs
     */
    public static String utf8Encode(String str) {
        if (!isEmpty(str) && str.getBytes().length != str.length()) {
            try {
                return URLEncoder.encode(str, "UTF-8");
            } catch (UnsupportedEncodingException e) {
                throw new RuntimeException("UnsupportedEncodingException occurred. ", e);
            }
        }
        return str;
    }

    /**
     * encoded in utf-8, if exception, return defultReturn
     *
     * @param str
     * @param defultReturn
     * @return
     */
    public static String utf8Encode(String str, String defultReturn) {
        if (!isEmpty(str) && str.getBytes().length != str.length()) {
            try {
                return URLEncoder.encode(str, "UTF-8");
            } catch (UnsupportedEncodingException e) {
                return defultReturn;
            }
        }
        return str;
    }

    /**
     * get innerHtml from href
     *
     * <pre>
     * getHrefInnerHtml(null)                                  = ""
     * getHrefInnerHtml("")                                    = ""
     * getHrefInnerHtml("mp3")                                 = "mp3";
     * getHrefInnerHtml("&lt;a innerHtml&lt;/a&gt;")                    = "&lt;a innerHtml&lt;/a&gt;";
     * getHrefInnerHtml("&lt;a&gt;innerHtml&lt;/a&gt;")                    = "innerHtml";
     * getHrefInnerHtml("&lt;a&lt;a&gt;innerHtml&lt;/a&gt;")                    = "innerHtml";
     * getHrefInnerHtml("&lt;a href="baidu.com"&gt;innerHtml&lt;/a&gt;")               = "innerHtml";
     * getHrefInnerHtml("&lt;a href="baidu.com" title="baidu"&gt;innerHtml&lt;/a&gt;") = "innerHtml";
     * getHrefInnerHtml("   &lt;a&gt;innerHtml&lt;/a&gt;  ")                           = "innerHtml";
     * getHrefInnerHtml("&lt;a&gt;innerHtml&lt;/a&gt;&lt;/a&gt;")                      = "innerHtml";
     * getHrefInnerHtml("jack&lt;a&gt;innerHtml&lt;/a&gt;&lt;/a&gt;")                  = "innerHtml";
     * getHrefInnerHtml("&lt;a&gt;innerHtml1&lt;/a&gt;&lt;a&gt;innerHtml2&lt;/a&gt;")        = "innerHtml2";
     * </pre>
     *
     * @param href
     * @return <ul>
     *         <li>if href is null, return ""</li>
     *         <li>if not match regx, return source</li>
     *         <li>return the last string that match regx</li>
     *         </ul>
     */
    public static String getHrefInnerHtml(String href) {
        if (isEmpty(href)) {
            return "";
        }

        String hrefReg = ".*<[\\s]*a[\\s]*.*>(.+?)<[\\s]*/a[\\s]*>.*";
        Pattern hrefPattern = Pattern.compile(hrefReg, Pattern.CASE_INSENSITIVE);
        Matcher hrefMatcher = hrefPattern.matcher(href);
        if (hrefMatcher.matches()) {
            return hrefMatcher.group(1);
        }
        return href;
    }

    /**
     * process special char in html
     *
     * <pre>
     * htmlEscapeCharsToString(null) = null;
     * htmlEscapeCharsToString("") = "";
     * htmlEscapeCharsToString("mp3") = "mp3";
     * htmlEscapeCharsToString("mp3&lt;") = "mp3<";
     * htmlEscapeCharsToString("mp3&gt;") = "mp3\>";
     * htmlEscapeCharsToString("mp3&amp;mp4") = "mp3&mp4";
     * htmlEscapeCharsToString("mp3&quot;mp4") = "mp3\"mp4";
     * htmlEscapeCharsToString("mp3&lt;&gt;&amp;&quot;mp4") = "mp3\<\>&\"mp4";
     * </pre>
     *
     * @param source
     * @return
     */
    public static String htmlEscapeCharsToString(String source) {
        return StringUtils.isEmpty(source) ? source : source.replaceAll("&lt;", "<").replaceAll("&gt;", ">")
                .replaceAll("&amp;", "&").replaceAll("&quot;", "\"");
    }

    /**
     * transform half width char to full width char
     *
     * <pre>
     * fullWidthToHalfWidth(null) = null;
     * fullWidthToHalfWidth("") = "";
     * fullWidthToHalfWidth(new String(new char[] {12288})) = " ";
     * fullWidthToHalfWidth("！＂＃＄％＆) = "!\"#$%&";
     * </pre>
     *
     * @param s
     * @return
     */
    public static String fullWidthToHalfWidth(String s) {
        if (isEmpty(s)) {
            return s;
        }

        char[] source = s.toCharArray();
        for (int i = 0; i < source.length; i++) {
            if (source[i] == 12288) {
                source[i] = ' ';
                // } else if (source[i] == 12290) {
                // source[i] = '.';
            } else if (source[i] >= 65281 && source[i] <= 65374) {
                source[i] = (char)(source[i] - 65248);
            } else {
                source[i] = source[i];
            }
        }
        return new String(source);
    }

    /**
     * transform full width char to half width char
     *
     * <pre>
     * halfWidthToFullWidth(null) = null;
     * halfWidthToFullWidth("") = "";
     * halfWidthToFullWidth(" ") = new String(new char[] {12288});
     * halfWidthToFullWidth("!\"#$%&) = "！＂＃＄％＆";
     * </pre>
     *
     * @param s
     * @return
     */
    public static String halfWidthToFullWidth(String s) {
        if (isEmpty(s)) {
            return s;
        }

        char[] source = s.toCharArray();
        for (int i = 0; i < source.length; i++) {
            if (source[i] == ' ') {
                source[i] = (char)12288;
                // } else if (source[i] == '.') {
                // source[i] = (char)12290;
            } else if (source[i] >= 33 && source[i] <= 126) {
                source[i] = (char)(source[i] + 65248);
            } else {
                source[i] = source[i];
            }
        }
        return new String(source);
    }

    /**
     * compare two string
     *
     * @param actual
     * @param expected
     * @return
     */
    public static boolean isEquals(String actual, String expected) {
        return actual == expected || (actual == null ? expected == null : actual.equals(expected));
    }

    /** Splits a String based on a single character, which is usually faster than regex-based String.split(). */
    public static String[] fastSplit(String string, char delimiter) {
        List<String> list = new ArrayList<String>();
        int size = string.length();
        int start = 0;
        for (int i = 0; i < size; i++) {
            if (string.charAt(i) == delimiter) {
                if (start < i) {
                    list.add(string.substring(start, i));
                } else {
                    list.add("");
                }
                start = i + 1;
            } else if (i == size - 1) {
                list.add(string.substring(start, size));
            }
        }
        String[] elements = new String[list.size()];
        list.toArray(elements);
        return elements;
    }

    /**
     * URL-Encodes a given string using UTF-8 (some web pages have problems with UTF-8 and umlauts, consider
     * {@link #encodeUrlIso(String)} also). No UnsupportedEncodingException to handle as it is dealt with in this
     * method.
     */
    public static String encodeUrl(String stringToEncode) {
        try {
            return URLEncoder.encode(stringToEncode, "UTF-8");
        } catch (UnsupportedEncodingException e1) {
            throw new RuntimeException(e1);
        }
    }

    /**
     * URL-encodes a given string using ISO-8859-1, which may work better with web pages and umlauts compared to UTF-8.
     * No UnsupportedEncodingException to handle as it is dealt with in this method.
     */
    public static String encodeUrlIso(String stringToEncode) {
        try {
            return URLEncoder.encode(stringToEncode, "ISO-8859-1");
        } catch (UnsupportedEncodingException e1) {
            throw new RuntimeException(e1);
        }
    }

    /**
     * URL-Decodes a given string using UTF-8. No UnsupportedEncodingException to handle as it is dealt with in this
     * method.
     */
    public static String decodeUrl(String stringToDecode) {
        try {
            return URLDecoder.decode(stringToDecode, "UTF-8");
        } catch (UnsupportedEncodingException e1) {
            throw new RuntimeException(e1);
        }
    }

    /**
     * URL-Decodes a given string using ISO-8859-1. No UnsupportedEncodingException to handle as it is dealt with in
     * this method.
     */
    public static String decodeUrlIso(String stringToDecode) {
        try {
            return URLDecoder.decode(stringToDecode, "ISO-8859-1");
        } catch (UnsupportedEncodingException e1) {
            throw new RuntimeException(e1);
        }
    }

    /**
     * Generates the MD5 digest for a given String based on UTF-8. The digest is padded with zeroes in the front if
     * necessary.
     *
     * @return MD5 digest (32 characters).
     */
    public static String generateMD5String(String stringToEncode) {
        return generateDigestString(stringToEncode, "MD5", "UTF-8", 32);
    }

    /**
     * Generates the SHA-1 digest for a given String based on UTF-8. The digest is padded with zeroes in the front if
     * necessary. The SHA-1 algorithm is considers to produce less collisions than MD5.
     *
     * @return SHA-1 digest (40 characters).
     */
    public static String generateSHA1String(String stringToEncode) {
        return generateDigestString(stringToEncode, "SHA-1", "UTF-8", 40);
    }

    public static String
    generateDigestString(String stringToEncode, String digestAlgo, String encoding, int lengthToPad) {
        // Loosely inspired by http://workbench.cadenhead.org/news/1428/creating-md5-hashed-passwords-java
        MessageDigest digester;
        try {
            digester = MessageDigest.getInstance(digestAlgo);
        } catch (NoSuchAlgorithmException nsae) {
            throw new RuntimeException(nsae);
        }
        try {
            digester.update(stringToEncode.getBytes(encoding));
        } catch (UnsupportedEncodingException e) {
            throw new RuntimeException(e);
        }
        return toHexString(digester.digest(), lengthToPad);
    }

    public static String toHexString(byte[] bytes, int lengthToPad) {
        BigInteger hash = new BigInteger(1, bytes);
        String digest = hash.toString(16);

        while (digest.length() < lengthToPad) {
            digest = "0" + digest;
        }
        return digest;
    }

    /**
     * Simple HTML/XML entity resolving: Only supports unicode enitities and a very limited number text represented
     * entities (apos, quot, gt, lt, and amp). There are many more: http://www.w3.org/TR/REC-html40/sgml/dtd.html
     *
     * @param entity The entity name without & and ; (null throws NPE)
     * @return Resolved entity or the entity itself if it could not be resolved.
     */
    public static String resolveEntity(String entity) {
        if (entity.length() > 1 && entity.charAt(0) == '#') {
            if (entity.charAt(1) == 'x') {
                return String.valueOf((char) Integer.parseInt(entity.substring(2), 16));
            } else {
                return String.valueOf((char) Integer.parseInt(entity.substring(1)));
            }
        } else if (entity.equals("apos")) {
            return "'";
        } else if (entity.equals("quot")) {
            return "\"";
        } else if (entity.equals("gt")) {
            return ">";
        } else if (entity.equals("lt")) {
            return "<";
        } else if (entity.equals("amp")) {
            return "&";
        } else {
            return entity;
        }
    }

    /**
     * Cuts the string at the end if it's longer than maxLength and appends "..." to it. The length of the resulting
     * string including "..." is always less or equal to the given maxLength. It's valid to pass a null text; in this
     * case null is returned.
     */
    public static String ellipsize(String text, int maxLength) {
        if (text != null && text.length() > maxLength) {
            return text.substring(0, maxLength - 3) + "...";
        }
        return text;
    }

    public static String[] splitLines(String text, boolean skipEmptyLines) {
        if (skipEmptyLines) {
            return text.split("[\n\r]+");
        } else {
            return text.split("\\r?\\n");
        }
    }

    public static List<String> findLinesContaining(String text, String searchText) {
        String[] splitLinesSkipEmpty = splitLines(text, true);
        List<String> matching = new ArrayList<String>();
        for (String line : splitLinesSkipEmpty) {
            if (line.contains(searchText)) {
                matching.add(line);
            }
        }
        return matching;
    }

    /**
     * Returns a concatenated string consisting of the given lines seperated by a new line character \n. The last line
     * does not have a \n at the end.
     */
    public static String concatLines(List<String> lines) {
        StringBuilder builder = new StringBuilder();
        int countMinus1 = lines.size() - 1;
        for (int i = 0; i < countMinus1; i++) {
            builder.append(lines.get(i)).append('\n');
        }
        if (!lines.isEmpty()) {
            builder.append(lines.get(countMinus1));
        }
        return builder.toString();
    }

    public static String joinIterableOnComma(Iterable<?> iterable) {
        if (iterable != null) {

            StringBuilder buf = new StringBuilder();
            Iterator<?> it = iterable.iterator();
            while (it.hasNext()) {
                buf.append(it.next());
                if (it.hasNext()) {
                    buf.append(',');
                }
            }
            return buf.toString();
        } else {
            return "";
        }
    }

    public static String joinArrayOnComma(int[] array) {
        if (array != null) {
            StringBuilder buf = new StringBuilder();
            for (int i = 0; i < array.length; i++) {
                if (i != 0) {
                    buf.append(',');
                }
                buf.append(array[i]);
            }
            return buf.toString();
        } else {
            return "";
        }
    }

    public static String joinArrayOnComma(String[] array) {
        if (array != null) {
            StringBuilder buf = new StringBuilder();
            for (int i = 0; i < array.length; i++) {
                if (i != 0) {
                    buf.append(',');
                }
                buf.append(array[i]);
            }
            return buf.toString();
        } else {
            return "";
        }

    }
    // /** not really public yet, umlauts!? */
    // public static boolean __isValidEmail(String email) {
    // // TODO compile and cache pattern using a ThreadLocal
    // return Pattern.matches("^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\\.([a-zA-Z])+([a-zA-Z])+", email);
    // }

    /**
     * Used to build output as Hex
     */
    private static final char[] DIGITS_LOWER = {'0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd',
            'e', 'f'                         };

    /**
     * encode By MD5
     *
     * @param str
     * @return String
     */
    public static String md5(String str) {
        if (str == null) {
            return null;
        }
        try {
            MessageDigest messageDigest = MessageDigest.getInstance("MD5");
            messageDigest.update(str.getBytes());
            return new String(encodeHex(messageDigest.digest()));
        } catch (Exception e) {
            throw new RuntimeException(e);
        }
    }

    /**
     * Converts an array of bytes into an array of characters representing the hexadecimal values of each byte in order.
     * The returned array will be double the length of the passed array, as it takes two characters to represent any
     * given byte.
     *
     * @param data a byte[] to convert to Hex characters
     * @return A char[] containing hexadecimal characters
     */
    protected static char[] encodeHex(final byte[] data) {
        final int l = data.length;
        final char[] out = new char[l << 1];
        // two characters form the hex value.
        for (int i = 0, j = 0; i < l; i++) {
            out[j++] = DIGITS_LOWER[(0xF0 & data[i]) >>> 4];
            out[j++] = DIGITS_LOWER[0x0F & data[i]];
        }
        return out;
    }
}
