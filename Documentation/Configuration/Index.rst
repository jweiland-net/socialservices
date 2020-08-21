.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

.. tip::

   You must configure the extension maps2 first to run this extension correctly.

   `Maps2 Documentation <https://docs.typo3.org/p/jweiland/maps2/master/en-us/>`_

Extension configuration
=======================

rootCategory
.............

In each project record you have the possibility to add one or more areas of activity.
In huge installations it's better to define a root category here to NOT show all categories.

poiCollectionPid
................

Define a storage pid where to store records of type Point of Interest of ext:maps2.

TypoScript configuration
========================

Use the constant editor and select tx_pfprojects to set those settings.

Configure page ids for socialservices plugin
............................................

You can configure the maps2 detail view target page and project detail page using the constants.

Include jQuery
..............

Include jQuery libraries using the constants includeJQueryLibrary, includeJQueryUiLibrary and includeJQueryUiCss (CSS for jQuery UI)

Default storage pid
...................

Don't want to store all records at the plugin page? No problem, you can configure a custom storage page id (or storage folder)
using the storagePid setting.

Page browser
............

You can configure itemsPerPage, if the page browser should be inserted above and/or below and the maximum number of pages.
