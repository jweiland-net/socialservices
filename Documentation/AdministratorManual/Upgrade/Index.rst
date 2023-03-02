.. include:: /Includes.rst.txt


.. _upgrade:

=======
Upgrade
=======

If you update EXT:socialservices to a newer version, please read this section carefully!

Update to Version 5.0.0
=======================

We have added TYPO3 11 compatibiliy.

Currently, there is nothing more to do.

Update to Version 4.0.0
=======================

We have removed TYPO3 9 compatibility.

As ViewHelper widgets are deprecated since TYPO3 10 we are using the new Paginator API now.
So please update following Fluid Templates:

*   Partials/Helpdesk/List.html
*   Templates/Helpdesk/List.html
*   Templates/Helpdesk/Search.html
