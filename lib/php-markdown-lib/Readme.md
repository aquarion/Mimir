PHP Markdown
============

PHP Markdown Lib 1.3-beta1 - Sun 13 Jan 2013

by Michel Fortin  
<http://michelf.ca/>

based on Markdown by John Gruber  
<http://daringfireball.net/>


Introduction
------------

This is a library package that includes both PHP Markdown and its sibling
PHP Markdown Extra which additional features.

Markdown is a text-to-HTML conversion tool for web writers. Markdown
allows you to write using an easy-to-read, easy-to-write plain text
format, then convert it to structurally valid XHTML (or HTML).

"Markdown" is two things: a plain text markup syntax, and a software 
tool, written in Perl, that converts the plain text markup to HTML. 
PHP Markdown is a port to PHP of the original Markdown program by 
John Gruber.

PHP Markdown can work as a plug-in for WordPress, as a modifier for
the Smarty templating engine, or as a replacement for Textile
formatting in any software that supports Textile.

Full documentation of Markdown's syntax is available on John's 
Markdown page: <http://daringfireball.net/projects/markdown/>


Installation and Requirement
----------------------------

This library package requires PHP 5.3 or later.

Note: The older plugin/library hybrid package for PHP Markdown and
PHP Markdown Extra is still maintained and will work with PHP 4.0.5 and later.

Before PHP 5.3.7, pcre.backtrack_limit defaults to 100 000, which is too small
in many situations. You might need to set it to higher values. Later PHP 
releases defaults to 1 000 000, which is usually fine.


Usage
-----

You can use PHP Markdown easily in your PHP program. This library package
is meant to be used with autoloading, so putting the 'Michelf' folder
in your include path should be enough for this to work:

	use \Michelf\Markdown;
	$my_html = Markdown::defaultTransform($my_text);

PHP Markdown Extra is also available the same way:

	use \Michelf\MarkdownExtra;
	$my_html = MarkdownExtra::defaultTransform($my_text);

If you wish to use PHP Markdown with another text filter function 
built to parse HTML, you should filter the text *after* the Markdown
function call. This is an example with [PHP SmartyPants][psp]:

	use \Michelf\Markdown, \Michelf\SmartyPants;
	$my_html = Markdown::defaultTransform($my_text);
	$my_html = SmartyPants::defaultTransform($my_html);

All these examples are using the static `markdown` function found inside the 
parser class. If you want to customize the parser, you can also instantiate
it directly and change some configuration variables:

	use \Michelf\MarkdownExtra;
	$parser = new MarkdownExtra;
	$parser->fn_id_prefix = "post22-";
	$my_html = $parser->transform($my_text);


Configuration
-------------

By default, PHP Markdown produces XHTML output for tags with empty 
elements. E.g.:

    <br />

Markdown can be configured to produce HTML-style tags; e.g.:

    <br>

To do this, you must set the `empty_element_suffix` variable of the parser
object to ">".


Bugs
----

To file bug reports please send email to:
<michel.fortin@michelf.ca>

Please include with your report: (1) the example input; (2) the output you
expected; (3) the output PHP Markdown actually produced.

If you have a problem where Markdown gives you an empty result, first check 
that the backtrack limit is not too low by running `php --info | grep pcre`.
See Installation and Requirement above for details.


Version History
---------------

Current Lib:

*	Changed HTML output for footnotes: now instead of adding `rel` and `rev`
	attributes, footnotes links have the class name `footnote-ref` and
	backlinks `footnote-backref`. (This change only affect Lib branch.)

*	Corrected namespace capitalization in composer package definition file.


Lib 1.3-beta4 (21 Jan 2013):

*	Changed namespace name from michelf (lowercase) to Michelf (capitalized).

*	Fixed some regular expressions to make PCRE not shout warnings about POSIX
	collation classes (dependent on your version of PCRE).


Lib 1.3-beta2 (14 Jan 2013):

*	Fixed missing autoloading information for composer.


Lib 1.3-beta1 (13 Jan 2013):

Extra 1.2.6 (13 Jan 2013):

*	Headers can now have a class attribute. You can add a class inside the
	extra attribute block which can optionally be put after a header:

		### Header ###  {#id .class1 .class2}
	
	Spaces between components in the brace is optional.

*	Fenced code blocks can also have a class and an id attribute. If you only
	need to apply a class (typically to indicate the language of a code 
	snippet), you can write it like this:
	
		~~~ html
		<b>bold</b>
		~~~
	
	or like this:
	
		~~~ .html
		<b>bold</b>
		~~~
	
	There is a new configuration option `MARKDOWN_CODE_CLASS_PREFIX` you can
	use if you need to append a prefix to the class name.
	
	You might also opt to use an extra attribute block just like for headers:
	
		~~~ {.html #id .codeclass}
		<b>bold</b>
		~~~
	
	Note that class names added this way are not affected by the 
	MARKDOWN_CODE_CLASS_PREFIX.
	
	A code block creates a `pre` HTML element containing a `code` element. 
	The `code` HTML element is the one that receives the attribute. If for
	some reason you need attributes to be applied to the enclosing `pre`
	element instead, you can set the MARKDOWN_CODE_ATTR_ON_PRE configuration 
	variable to true.

*	Fixed an issue were consecutive fenced code blocks containing HTML-like
	code would confuse the parser.

*	Multiple references to the same footnote are now allowed.

*	Fixed an issue where no_markup mode was ineffective.


1.0.1p (13 Jan 2013):

*	Created a library-style unified package that will work with namespace-based 
	autoloading introduced in PHP 5.3. This is the same parser, but packaged
	differently. It is available separatedly from the two other available 
	packages, and requires PHP 5.3.

*	The following HTML 5 elements are treated as block elements when at the
	root of an HTML block: `article`, `section`, `nav`, `aside`, `hgroup`, 
	`header`, `footer`, and `figure`. `svg` too.

*	Fixed an issue where some XML-style empty tags (such as `<br/>`) were not 
	recognized correctly as such when inserted into Markdown-formatted text.


1.0.1o (8 Jan 2012):

*	Silenced a new warning introduced around PHP 5.3 complaining about
	POSIX characters classes not being implemented. PHP Markdown does not
	use POSIX character classes, but it nevertheless trigged that warning.


Extra 1.2.5 (8 Jan 2012):

*	Fixed an issue preventing fenced code blocks indented inside lists items 
	and elsewhere from being interpreted correctly.

*	Fixed an issue where HTML tags inside fenced code blocks were sometime
	not encoded with entities.


1.0.1n (10 Oct 2009):

*	Enabled reference-style shortcut links. Now you can write reference-style 
	links with less brakets:

		This is [my website].

		[my website]: http://example.com/

	This was added in the 1.0.2 betas, but commented out in the 1.0.1 branch, 
	waiting for the feature to be officialized. [But half of the other Markdown
	implementations are supporting this syntax][half], so it makes sense for 
	compatibility's sake to allow it in PHP Markdown too.

 [half]: http://babelmark.bobtfish.net/?markdown=This+is+%5Bmy+website%5D.%0D%0A%09%09%0D%0A%5Bmy+website%5D%3A+http%3A%2F%2Fexample.com%2F%0D%0A&src=1&dest=2

*	Now accepting many valid email addresses in autolinks that were 
	previously rejected, such as:

		<abc+mailbox/department=shipping@example.com>
		<!#$%&'*+-/=?^_`.{|}~@example.com>
		<"abc@def"@example.com>
		<"Fred Bloggs"@example.com>
		<jsmith@[192.0.2.1]>

*	Now accepting spaces in URLs for inline and reference-style links. Such 
	URLs need to be surrounded by angle brakets. For instance:

		[link text](<http://url/with space> "optional title")

		[link text][ref]
		[ref]: <http://url/with space> "optional title"
	
	There is still a quirk which may prevent this from working correctly with 
	relative URLs in inline-style links however.

*	Fix for adjacent list of different kind where the second list could
	end as a sublist of the first when not separated by an empty line.

*	Fixed a bug where inline-style links wouldn't be recognized when the link 
	definition contains a line break between the url and the title.

*	Fixed a bug where tags where the name contains an underscore aren't parsed 
	correctly.

*	Fixed some corner-cases mixing underscore-ephasis and asterisk-emphasis.


Extra 1.2.4 (10 Oct 2009):

*	Fixed a problem where unterminated tags in indented code blocks could 
	prevent proper escaping of characaters in the code block.


Extra 1.2.3 (31 Dec 2008):

*	In WordPress pages featuring more than one post, footnote id prefixes are 
	now automatically applied with the current post ID to avoid clashes
	between footnotes belonging to different posts.

*	Fix for a bug introduced in Extra 1.2 where block-level HTML tags where 
	not detected correctly, thus the addition of erroneous `<p>` tags and
	interpretation of their content as Markdown-formatted instead of
	HTML-formatted.


Extra 1.2.2 (21 Jun 2008):

*	Fixed a problem where abbreviation definitions, footnote
	definitions and link references were stripped inside
	fenced code blocks.

*	Fixed a bug where characters such as `"` in abbreviation
	definitions weren't properly encoded to HTML entities.

*	Fixed a bug where double quotes `"` were not correctly encoded
	as HTML entities when used inside a footnote reference id.


1.0.1m (21 Jun 2008):

*	Lists can now have empty items.

*	Rewrote the emphasis and strong emphasis parser to fix some issues
	with odly placed and overlong markers.


Extra 1.2.1 (27 May 2008):

*	Fixed a problem where Markdown headers and horizontal rules were
	transformed into their HTML equivalent inside fenced code blocks.


Extra 1.2 (11 May 2008):

*	Added fenced code block syntax which don't require indentation
	and can start and end with blank lines. A fenced code block
	starts with a line of consecutive tilde (~) and ends on the
	next line with the same number of consecutive tilde. Here's an
	example:
	
	    ~~~~~~~~~~~~
		Hello World!
		~~~~~~~~~~~~

*	Rewrote parts of the HTML block parser to better accomodate
	fenced code blocks.

*	Footnotes may now be referenced from within another footnote.

*	Added programatically-settable parser property `predef_attr` for 
	predefined attribute definitions.

*	Fixed an issue where an indented code block preceded by a blank
	line containing some other whitespace would confuse the HTML 
	block parser into creating an HTML block when it should have 
	been code.


1.0.1l (11 May 2008):

*	Now removing the UTF-8 BOM at the start of a document, if present.

*	Now accepting capitalized URI schemes (such as HTTP:) in automatic
	links, such as `<HTTP://EXAMPLE.COM/>`.

*	Fixed a problem where `<hr@example.com>` was seen as a horizontal
	rule instead of an automatic link.

*	Fixed an issue where some characters in Markdown-generated HTML
	attributes weren't properly escaped with entities.

*	Fix for code blocks as first element of a list item. Previously,
	this didn't create any code block for item 2:

		*   Item 1 (regular paragraph)

		*       Item 2 (code block)

*	A code block starting on the second line of a document wasn't seen
	as a code block. This has been fixed.

*	Added programatically-settable parser properties `predef_urls` and 
	`predef_titles` for predefined URLs and titles for reference-style 
	links. To use this, your PHP code must call the parser this way:

		$parser = new Markdwon_Parser;
		$parser->predef_urls = array('linkref' => 'http://example.com');
		$html = $parser->transform($text);

	You can then use the URL as a normal link reference:
	
		[my link][linkref]	
		[my link][linkRef]

	Reference names in the parser properties *must* be lowercase.
	Reference names in the Markdown source may have any case.

*	Added `setup` and `teardown` methods which can be used by subclassers
	as hook points to arrange the state of some parser variables before and 
	after parsing.


Extra 1.1.7 (26 Sep 2007):

1.0.1k (26 Sep 2007):

*	Fixed a problem introduced in 1.0.1i where three or more identical
	uppercase letters, as well as a few other symbols, would trigger
	a horizontal line.


Extra 1.1.6 (4 Sep 2007):

1.0.1j (4 Sep 2007):

*	Fixed a problem introduced in 1.0.1i where the closing `code` and 
	`pre` tags at the end of a code block were appearing in the wrong 
	order.

*	Overriding configuration settings by defining constants from an 
	external before markdown.php is included is now possible without 
	producing a PHP warning.


Extra 1.1.5 (31 Aug 2007):

1.0.1i (31 Aug 2007):

*	Fixed a problem where an escaped backslash before a code span 
	would prevent the code span from being created. This should now
	work as expected:
	
		Litteral backslash: \\`code span`

*	Overall speed improvements, especially with long documents.


Extra 1.1.4 (3 Aug 2007):

1.0.1h (3 Aug 2007):

*	Added two properties (`no_markup` and `no_entities`) to the parser 
	allowing HTML tags and entities to be disabled.

*	Fix for a problem introduced in 1.0.1g where posting comments in 
	WordPress would trigger PHP warnings and cause some markup to be 
	incorrectly filtered by the kses filter in WordPress.


Extra 1.1.3 (3 Jul 2007):

*	Fixed a performance problem when parsing some invalid HTML as an HTML 
	block which was resulting in too much recusion and a segmentation fault 
	for long documents.

*	The markdown="" attribute now accepts unquoted values.

*	Fixed an issue where underscore-emphasis didn't work when applied on the 
	first or the last word of an element having the markdown="1" or 
	markdown="span" attribute set unless there was some surrounding whitespace.
	This didn't work:
	
		<p markdown="1">_Hello_ _world_</p>
	
	Now it does produce emphasis as expected.

*	Fixed an issue preventing footnotes from working when the parser's 
	footnote id prefix variable (fn_id_prefix) is not empty.

*	Fixed a performance problem where the regular expression for strong 
	emphasis introduced in version 1.1 could sometime be long to process, 
	give slightly wrong results, and in some circumstances could remove 
	entirely the content for a whole paragraph.

*	Fixed an issue were abbreviations tags could be incorrectly added 
	inside URLs and title of links.

*	Placing footnote markers inside a link, resulting in two nested links, is 
	no longer allowed.


1.0.1g (3 Jul 2007):

*	Fix for PHP 5 compiled without the mbstring module. Previous fix to 
	calculate the length of UTF-8 strings in `detab` when `mb_strlen` is 
	not available was only working with PHP 4.

*	Fixed a problem with WordPress 2.x where full-content posts in RSS feeds 
	were not processed correctly by Markdown.

*	Now supports URLs containing literal parentheses for inline links 
	and images, such as:

		[WIMP](http://en.wikipedia.org/wiki/WIMP_(computing))

	Such parentheses may be arbitrarily nested, but must be
	balanced. Unbalenced parentheses are allowed however when the URL 
	when escaped or when the URL is enclosed in angle brakets `<>`.

*	Fixed a performance problem where the regular expression for strong 
	emphasis introduced in version 1.0.1d could sometime be long to process, 
	give slightly wrong results, and in some circumstances could remove 
	entirely the content for a whole paragraph.

*	Some change in version 1.0.1d made possible the incorrect nesting of 
	anchors within each other. This is now fixed.

*	Fixed a rare issue where certain MD5 hashes in the content could
	be changed to their corresponding text. For instance, this:

		The MD5 value for "+" is "26b17225b626fb9238849fd60eabdf60".
	
	was incorrectly changed to this in previous versions of PHP Markdown:

		<p>The MD5 value for "+" is "+".</p>

*	Now convert escaped characters to their numeric character 
	references equivalent.
	
	This fix an integration issue with SmartyPants and backslash escapes. 
	Since Markdown and SmartyPants have some escapable characters in common, 
	it was sometime necessary to escape them twice. Previously, two 
	backslashes were sometime required to prevent Markdown from "eating" the 
	backslash before SmartyPants sees it:
	
		Here are two hyphens: \\--
	
	Now, only one backslash will do:
	
		Here are two hyphens: \--


Extra 1.1.2 (7 Feb 2007)

*	Fixed an issue where headers preceded too closely by a paragraph 
	(with no blank line separating them) where put inside the paragraph.

*	Added the missing TextileRestricted method that was added to regular
	PHP Markdown since 1.0.1d but which I forgot to add to Extra.


1.0.1f (7 Feb 2007):

*	Fixed an issue with WordPress where manually-entered excerpts, but 
	not the auto-generated ones, would contain nested paragraphs.

*	Fixed an issue introduced in 1.0.1d where headers and blockquotes 
	preceded too closely by a paragraph (not separated by a blank line) 
	where incorrectly put inside the paragraph.

*	Fixed an issue introduced in 1.0.1d in the tokenizeHTML method where 
	two consecutive code spans would be merged into one when together they 
	form a valid tag in a multiline paragraph.

*	Fixed an long-prevailing issue where blank lines in code blocks would 
	be doubled when the code block is in a list item.
	
	This was due to the list processing functions relying on artificially 
	doubled blank lines to correctly determine when list items should 
	contain block-level content. The list item processing model was thus 
	changed to avoid the need for double blank lines.

*	Fixed an issue with `<% asp-style %>` instructions used as inline 
	content where the opening `<` was encoded as `&lt;`.

*	Fixed a parse error occuring when PHP is configured to accept 
	ASP-style delimiters as boundaries for PHP scripts.

*	Fixed a bug introduced in 1.0.1d where underscores in automatic links
	got swapped with emphasis tags.


Extra 1.1.1 (28 Dec 2006)

*	Fixed a problem where whitespace at the end of the line of an atx-style
	header would cause tailing `#` to appear as part of the header's content.
	This was caused by a small error in the regex that handles the definition
	for the id attribute in PHP Markdown Extra.

*	Fixed a problem where empty abbreviations definitions would eat the 
	following line as its definition.

*	Fixed an issue with calling the Markdown parser repetitivly with text 
	containing footnotes. The footnote hashes were not reinitialized properly.


1.0.1e (28 Dec 2006)

*	Added support for internationalized domain names for email addresses in 
	automatic link. Improved the speed at which email addresses are converted 
	to entities. Thanks to Milian Wolff for his optimisations.

*	Made deterministic the conversion to entities of email addresses in 
	automatic links. This means that a given email address will always be 
	encoded the same way.

*	PHP Markdown will now use its own function to calculate the length of an 
	UTF-8 string in `detab` when `mb_strlen` is not available instead of 
	giving a fatal error.


Extra 1.1 (1 Dec 2006)

*	Added a syntax for footnotes.

*	Added an experimental syntax to define abbreviations.


1.0.1d (1 Dec 2006)

*   Fixed a bug where inline images always had an empty title attribute. The 
	title attribute is now present only when explicitly defined.

*	Link references definitions can now have an empty title, previously if the 
	title was defined but left empty the link definition was ignored. This can 
	be useful if you want an empty title attribute in images to hide the 
	tooltip in Internet Explorer.

*	Made `detab` aware of UTF-8 characters. UTF-8 multi-byte sequences are now 
	correctly mapped to one character instead of the number of bytes.

*	Fixed a small bug with WordPress where WordPress' default filter `wpautop`
	was not properly deactivated on comment text, resulting in hard line breaks
	where Markdown do not prescribes them.

*	Added a `TextileRestrited` method to the textile compatibility mode. There
	is no restriction however, as Markdown does not have a restricted mode at 
	this point. This should make PHP Markdown work again in the latest 
	versions of TextPattern.

*   Converted PHP Markdown to a object-oriented design.

*	Changed span and block gamut methods so that they loop over a 
	customizable list of methods. This makes subclassing the parser a more 
	interesting option for creating syntax extensions.

*	Also added a "document" gamut loop which can be used to hook document-level 
	methods (like for striping link definitions).

*	Changed all methods which were inserting HTML code so that they now return 
	a hashed representation of the code. New methods `hashSpan` and `hashBlock`
	are used to hash respectivly span- and block-level generated content. This 
	has a couple of significant effects:
	
	1.	It prevents invalid nesting of Markdown-generated elements which 
	    could occur occuring with constructs like `*something [link*][1]`.
	2.	It prevents problems occuring with deeply nested lists on which 
	    paragraphs were ill-formed.
	3.	It removes the need to call `hashHTMLBlocks` twice during the the 
		block gamut.
	
	Hashes are turned back to HTML prior output.

*	Made the block-level HTML parser smarter using a specially-crafted regular 
	expression capable of handling nested tags.

*	Solved backtick issues in tag attributes by rewriting the HTML tokenizer to 
	be aware of code spans. All these lines should work correctly now:
	
		<span attr='`ticks`'>bar</span>
		<span attr='``double ticks``'>bar</span>
		`<test a="` content of attribute `">`

*	Changed the parsing of HTML comments to match simply from `<!--` to `-->` 
	instead using of the more complicated SGML-style rule with paired `--`.
	This is how most browsers parse comments and how XML defines them too.

*	`<address>` has been added to the list of block-level elements and is now
	treated as an HTML block instead of being wrapped within paragraph tags.

*	Now only trim trailing newlines from code blocks, instead of trimming
	all trailing whitespace characters.

*	Fixed bug where this:

		[text](http://m.com "title" )
		
	wasn't working as expected, because the parser wasn't allowing for spaces
	before the closing paren.

*	Filthy hack to support markdown='1' in div tags.

*	_DoAutoLinks() now supports the 'dict://' URL scheme.

*	PHP- and ASP-style processor instructions are now protected as
	raw HTML blocks.

		<? ... ?>
		<% ... %>

*	Fix for escaped backticks still triggering code spans:

		There are two raw backticks here: \` and here: \`, not a code span


Extra 1.0 - 5 September 2005

*   Added support for setting the id attributes for headers like this:
	
        Header 1            {#header1}
        ========
	
        ## Header 2 ##      {#header2}
	
    This only work only for headers for now.

*   Tables will now work correctly as the first element of a definition 
    list. For example, this input:

        Term

        :   Header  | Header
            ------- | -------
            Cell    | Cell
		    
    used to produce no definition list and a table where the first 
    header was named ": Header". This is now fixed.

*   Fix for a problem where a paragraph following a table was not 
    placed between `<p>` tags.


Extra 1.0b4 - 1 August 2005

*   Fixed some issues where whitespace around HTML blocks were trigging
    empty paragraph tags.

*   Fixed an HTML block parsing issue that would cause a block element 
    following a code span or block with unmatched opening bracket to be
    placed inside a paragraph.

*   Removed some PHP notices that could appear when parsing definition
    lists and tables with PHP notice reporting flag set.


Extra 1.0b3 - 29 July 2005

*   Definition lists now require a blank line before each term. Solves
    an ambiguity where the last line of lazy-indented definitions could 
    be mistaken by PHP Markdown as a new term in the list.

*   Definition lists now support multiple terms per definition.

*   Some special tags were replaced in the output by their md5 hash 
    key. Things such as this now work as expected:
	
        ## Header <?php echo $number ?> ##


Extra 1.0b2 - 26 July 2005

*   Definition lists can now take two or more definitions for one term.
    This should have been the case before, but a bug prevented this 
    from working right.

*   Fixed a problem where single column table with a pipe only at the
    end where not parsed as table. Here is such a table:
	
        | header
        | ------
        | cell

*   Fixed problems with empty cells in the first column of a table with 
    no leading pipe, like this one:
	
        header | header
        ------ | ------
               | cell

*   Code spans containing pipes did not within a table. This is now 
    fixed by parsing code spans before splitting rows into cells.

*   Added the pipe character to the backlash escape character lists.

Extra 1.0b1 (25 Jun 2005)

*   First public release of PHP Markdown Extra.


Copyright and License
---------------------

PHP Markdown & Extra  
Copyright (c) 2004-2013 Michel Fortin  
<http://michelf.ca/>  
All rights reserved.

Based on Markdown  
Copyright (c) 2003-2005 John Gruber   
<http://daringfireball.net/>   
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are
met:

*   Redistributions of source code must retain the above copyright 
    notice, this list of conditions and the following disclaimer.

*   Redistributions in binary form must reproduce the above copyright
    notice, this list of conditions and the following disclaimer in the
    documentation and/or other materials provided with the 
    distribution.

*   Neither the name "Markdown" nor the names of its contributors may
    be used to endorse or promote products derived from this software
    without specific prior written permission.

This software is provided by the copyright holders and contributors "as
is" and any express or implied warranties, including, but not limited
to, the implied warranties of merchantability and fitness for a
particular purpose are disclaimed. In no event shall the copyright owner
or contributors be liable for any direct, indirect, incidental, special,
exemplary, or consequential damages (including, but not limited to,
procurement of substitute goods or services; loss of use, data, or
profits; or business interruption) however caused and on any theory of
liability, whether in contract, strict liability, or tort (including
negligence or otherwise) arising in any way out of the use of this
software, even if advised of the possibility of such damage.
