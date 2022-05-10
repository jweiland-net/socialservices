.. include:: ../../Includes.txt

.. _extensionSettings:

==================
Extension Settings
==================

Some general settings for `socialservices` can be configured in *Admin Tools -> Settings*.

Tab: Basic
==========

poiCollectionPid
""""""""""""""""

Default: 0

Only valid, if you have installed EXT:maps2, too.

While creating location records we catch the address and automatically create a maps2 record
for you. Define a storage PID where we should store these records.

rootUid
"""""""

Default: 0

If you have many sys_category records with huge trees in your TYPO3 project, it may make sense to
reduce the category trees in our Plugins to a parent category UID (root UID).
