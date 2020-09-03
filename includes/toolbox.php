<?php

// BORROWED FROM DRUPAL7 INCLUDES/BOOTSTRAP.INC

/**
 * Formats text for emphasized display in a placeholder inside a sentence.
 *
 * Used automatically by format_string().
 *
 * @param $text
 *   The text to format (plain-text).
 *
 * @return
 *   The formatted text (html).
 */
function drupal_placeholder($text) {
  return '<em class="placeholder">' . check_plain($text) . '</em>';
}

/**
 * Formats a string for HTML display by replacing variable placeholders.
 *
 * This function replaces variable placeholders in a string with the requested
 * values and escapes the values so they can be safely displayed as HTML. It
 * should be used on any unknown text that is intended to be printed to an HTML
 * page (especially text that may have come from untrusted users, since in that
 * case it prevents cross-site scripting and other security problems).
 *
 * In most cases, you should use t() rather than calling this function
 * directly, since it will translate the text (on non-English-only sites) in
 * addition to formatting it.
 *
 * @param $string
 *   A string containing placeholders.
 * @param $args
 *   An associative array of replacements to make. Occurrences in $string of
 *   any key in $args are replaced with the corresponding value, after optional
 *   sanitization and formatting. The type of sanitization and formatting
 *   depends on the first character of the key:
 *   - @variable: Escaped to HTML using check_plain(). Use this as the default
 *     choice for anything displayed on a page on the site.
 *   - %variable: Escaped to HTML and formatted using drupal_placeholder(),
 *     which makes it display as <em>emphasized</em> text.
 *   - !variable: Inserted as is, with no sanitization or formatting. Only use
 *     this for text that has already been prepared for HTML display (for
 *     example, user-supplied text that has already been run through
 *     check_plain() previously, or is expected to contain some limited HTML
 *     tags and has already been run through filter_xss() previously).
 *
 * @see t()
 * @ingroup sanitization
 */
function format_string($string, array $args = array()) {
  // Transform arguments before inserting them.
  foreach ($args as $key => $value) {
    switch ($key[0]) {
      case '@':
        // Escaped only.
        $args[$key] = check_plain($value);
        break;
      case '%':
      default:
        // Escaped and placeholder.
        $args[$key] = drupal_placeholder($value);
        break;
      case '!':
        // Pass-through.
    }
  }
  return strtr($string, $args);
}
/**
 * Encodes special characters in a plain-text string for display as HTML.
 *
 * Also validates strings as UTF-8 to prevent cross site scripting attacks on
 * Internet Explorer 6.
 *
 * @param string $text
 *   The text to be checked or processed.
 *
 * @return string
 *   An HTML safe version of $text. If $text is not valid UTF-8, an empty string
 *   is returned and, on PHP < 5.4, a warning may be issued depending on server
 *   configuration (see @link https://bugs.php.net/bug.php?id=47494 @endlink).
 *
 * @see drupal_validate_utf8()
 * @ingroup sanitization
 */
function check_plain($text) {
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
/**
 * Checks whether a string is valid UTF-8.
 *
 * All functions designed to filter input should use drupal_validate_utf8
 * to ensure they operate on valid UTF-8 strings to prevent bypass of the
 * filter.
 *
 * When text containing an invalid UTF-8 lead byte (0xC0 - 0xFF) is presented
 * as UTF-8 to Internet Explorer 6, the program may misinterpret subsequent
 * bytes. When these subsequent bytes are HTML control characters such as
 * quotes or angle brackets, parts of the text that were deemed safe by filters
 * end up in locations that are potentially unsafe; An onerror attribute that
 * is outside of a tag, and thus deemed safe by a filter, can be interpreted
 * by the browser as if it were inside the tag.
 *
 * The function does not return FALSE for strings containing character codes
 * above U+10FFFF, even though these are prohibited by RFC 3629.
 *
 * @param $text
 *   The text to check.
 *
 * @return
 *   TRUE if the text is valid UTF-8, FALSE if not.
 */
function drupal_validate_utf8($text) {
  if (strlen($text) == 0) {
    return TRUE;
  }
  // With the PCRE_UTF8 modifier 'u', preg_match() fails silently on strings
  // containing invalid UTF-8 byte sequences. It does not reject character
  // codes above U+10FFFF (represented by 4 or more octets), though.
  return (preg_match('/^./us', $text) == 1);
}
/**
 * Returns the equivalent of Apache's $_SERVER['REQUEST_URI'] variable.
 *
 * Because $_SERVER['REQUEST_URI'] is only available on Apache, we generate an
 * equivalent using other environment variables.
 */
function request_uri() {
  if (isset($_SERVER['REQUEST_URI'])) {
    $uri = $_SERVER['REQUEST_URI'];
  }
  else {
    if (isset($_SERVER['argv'])) {
      $uri = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['argv'][0];
    }
    elseif (isset($_SERVER['QUERY_STRING'])) {
      $uri = $_SERVER['SCRIPT_NAME'] . '?' . $_SERVER['QUERY_STRING'];
    }
    else {
      $uri = $_SERVER['SCRIPT_NAME'];
    }
  }
  // Prevent multiple slashes to avoid cross site requests via the Form API.
  $uri = '/' . ltrim($uri, '/');
  return $uri;
}
