package com.aboutcoder.packease.util;

import android.util.Log;

/**
 * Copyright © 2013-2015 AboutCoder.COM. All rights reserved.
 *
 * @author chenjinlong
 * @datetime 6/2/15 8:20 PM
 * @description
 */
public class LogUtils {
    public static final boolean debugMode = true;

    public static void v(String tag, String msg) {
        if (debugMode)
            Log.v(tag, msg);
    }

    public static void v(String tag, String msg, Throwable tr) {
        if (debugMode)
            Log.v(tag, msg, tr);
    }

    public static void d(String tag, String msg) {
        if (debugMode)
            Log.d(tag, msg);
    }

    public static void d(String tag, String msg, Throwable tr) {
        if (debugMode)
            Log.d(tag, msg, tr);
    }

    public static void i(String tag, String msg) {
        if (debugMode)
            Log.i(tag, msg);
    }

    public static void i(String tag, String msg, Throwable tr) {
        if (debugMode)
            Log.i(tag, msg, tr);
    }

    public static void w(String tag, String msg) {
        if (debugMode)
            Log.w(tag, msg);
    }

    public static void w(String tag, String msg, Throwable tr) {
        if (debugMode)
            Log.w(tag, msg, tr);
    }

    public static void w(String tag, Throwable tr) {
        if (debugMode)
            Log.w(tag, tr);
    }

    public static void e(String tag, String msg) {
        if (debugMode)
            Log.e(tag, msg);
    }

    public static void e(String tag, String msg, Throwable tr) {
        if (debugMode)
            Log.e(tag, msg, tr);
    }

    public static void wtf(String tag, String msg) {
        if (debugMode)
            Log.wtf(tag, msg);
    }

    public static void wtf(String tag, String msg, Throwable tr) {
        if (debugMode)
            Log.wtf(tag, msg, tr);
    }
}
