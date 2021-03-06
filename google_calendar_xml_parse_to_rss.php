<?php 

// The "header" command tells the browser that what's coming in
//  is XML, not an HTML web page

header("Content-type: text/xml");

// Modified from P.J. Cabrera's "Listing 5" at 
// http://www.ibm.com/developerworks/opensource/library/os-php-xpath/
// License at http://www.ibm.com/developerworks/apps/download/index.jsp?contentid=270615&filename=os-php-xpath.google-calendar-api.zip&method=http&locale=worldwide:w

//  Set the time zone.  See the supported time zones here:
//   http://php.net/manual/en/timezones.php
//  As an example, we'll use US Eastern time, so

    date_default_timezone_set('America/New_York');

//  This tells the code where to look in Google's data protocal
//   to find the tags used in the calendar feed.  Note that
//   we're only looking at "confirmed" links.  For more details, see
//   http://code.google.com/apis/gdata/docs/1.0/elements.html

    $confirmed = 'http://schemas.google.com/g/2005#event.confirmed';

// This puts the date in a form Google will read:

    $right_now = date("Y-m-d\Th:i:sP", time());

// This puts the current date in the proper form for validation,
//  that is, "RFC-2822" formatted.

    $pubdate = date( "r", time() );

//  For our purposes, a week will be 8 days.  This allows next
//   Sunday's schedule to appear on the preceeding Sunday
//  Adjust for your own purposes


    $year_in_seconds = 60 * 60 * 24 * 7 * 52;
    $next_year = date("Y-m-d\Th:i:sP", time() + $year_in_seconds);

//  This is my version of the call to Google's API.  See
//   http://code.google.com/apis/calendar/data/2.0/reference.html#Parameters
//   for alternatives.

//   This version gets all the events happening starting from right now until
//   eight days from now.

//  Don't forget to replace "yourcalendaraddress" by your Google
//   calendar address.  For your default calendar, it's just your gmail
//   address before the "@gmail.com"
    $feed = "http://www.google.com/calendar/feeds/contact%40invernesscalvary.com/" . 
        "public/full?orderby=starttime&singleevents=true&" .
        "sortorder=ascending&" .
        "start-min=" . $right_now . "&" .
        "start-max=" . $next_year;

//  Create a new document from the feed

    $doc = new DOMDocument(); 
    $doc->load( $feed );

//  We're looking for all the entries in the feed, denoted, logically
//   enough, by the tag "entry"

    $entries = $doc->getElementsByTagName( "entry" ); 

//  If we've gotten this far we're probably golden.  print out the
//   header information for the XML file.  Note that this goes
//   down a long way, and we've escaped all the double quote
//   marks that we want to appear in the document.  Also note
//   that PHP's echo and print commands print linefeeds that appear
//   in the text.

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>

<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\">

<channel>

<title>Add your feed title here</title>\n";

// The next few lines link this XML page to the HTML page formed by
//  the other script.

echo "
<link>http://invernesscalvary.com.synapseresults.com/google_calendar_xml_parse_to_html.html</link>\n";

// The next line contains the address of your feed, i.e., the very
//  file you're editing right now

echo "<atom:link href=\"http://invernesscalvary.com.synapseresults.com/google_calendar_xml_parse_to_rss.php\" rel=\"self\" type=\"application/rss+xml\" />\n";

echo "
<description>Insert a suitable feed description</description>

<language>en</language>

<webMaster>youremail@address.com (Your Name [optional])</webMaster>

<category>Enter a list of category types</category>

<category>This helps feed aggregators figure out what they're aggregating</category>";

// pubDate and lastBuildDate are set to right now

echo "
<pubDate>$pubdate</pubDate>

<lastBuildDate>$pubdate</lastBuildDate>";

// This tells feed readers to come back in 1 day (24*60 minutes)

echo "
<ttl>1440</ttl>
";

//  This is pretty much self-explanatory

    foreach ( $entries as $entry ) { 
    
// Find the status of a given entry

        $status = $entry->getElementsByTagName( "eventStatus" ); 
        $eventStatus = $status->item(0)->getAttributeNode("value")->value;

// If it's confirmed, parse it

        if ($eventStatus == $confirmed) {

// This looks at the "title" tag.

            $titles = $entry->getElementsByTagName( "title" ); 
            $title = $titles->item(0)->nodeValue;

// $title might have an unescaped isolated ampersand in it (as in
//  "Chat & Chew".  This will fix that so that the feed will validate

            $title = ereg_replace(" & ", " &amp; ", $title);

// This looks at the "gd:when" tag,
//  to get the actual time the event is going to happen.
// Note that the "gd" indicates this is part of the Google schema

            $times = $entry->getElementsByTagName( "when" ); 

// Pull off the time

            $startTime = $times->item(0)->getAttributeNode("startTime")->value;

// Parse it into something we like.  For other formatting options see
// http://php.net/manual/en/function.date.php

	    $when = date( "l\, F j\, Y \a\\t h:i A T", strtotime( $startTime ) );

// There may be multiple link elements in the file.  This picks off
//  the first one, which takes you to the event page for the Google
//  calendar.  Note that "link", like "title", is not part of the
//  Google schema, so it's referenced by "<link ...>" rather than
//  "<gd:link ...>"

            $web = $entry->getElementsByTagName( "link" ); 
            $link = $web->item(0)->getAttributeNode("href")->value;

//  You can pick off other tags, of course, but these are the ones
//   I need.

//  Now we print an XML item for this entry.  Again note we escape
//   quotation marks that are needed in the XML page.  And we've
//   added new line characters, \n, just to make the final
//   page more readable

            echo "<item>\n";
            echo "<link>$link</link>\n";
            echo "<title>$title</title>\n";
            echo "<description>$when</description>\n";
            echo "<guid isPermaLink=\"true\">$link</guid>\n";
//            echo "<pubDate>$pubdate</pubDate>\n";
            echo "</item>\n\n"; 
	}
}

// Done looping, so close the remaining XML tags and quit.

echo "
</channel>

</rss>";

// and finally, end the PHP

?>
