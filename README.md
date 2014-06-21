moodstocks_php_api
==================

A simple php class for using the moodstocks API v2 from php


Example:


$mm=MoodstocksManager::getInstance();

##Echo the api to asure authentication
`$mm->ms_echo();`

##Add a new image to moodstocks
`$mm->ms_addimage("../userdata/img/37yFWIf1.jpg","image_id");`

##Enable image for offline sync
`$mm->ms_enableoffline("myid");`
