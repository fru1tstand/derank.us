package me.fru1t.annotation;

import java.lang.annotation.Documented;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;

/**
 * Marks a return or parameter type as nullable. Should be used in conjunction with an IDE's static null analysis.
 */
@Documented
@Retention(RetentionPolicy.SOURCE)
public @interface Nullable {

}
