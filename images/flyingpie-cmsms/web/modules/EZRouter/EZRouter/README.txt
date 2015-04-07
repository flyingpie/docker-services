Module makes you automatic routes using "Page URL" content property. With this module, your links doesn't need exactly fit to page urls any more. The additional parts of requested url will be add to $_GET array and set as smarty variable. Module supports named (associative) parameters too by adding path parts starting with "-".
Create new content. Then set the Page URL to specified values. You can test arguments by printing values at content body for example: {$arg1}

Some examples:
Page URL (content property): mypage/mysubpage
If the requested URL is: mypage/mysubpage/cat1/1/2
then the content will match and you will have the following smarty variables:
{$arg0} = cat1, {$arg1} = 1, {$arg2} = 2

Page URL (content property): mypage/mysubpage/-cat/-id1/-id2
If the requested URL is: mypage/mysubpage/cat1/1/2/extravar
then the content will match and you will have the following smarty variables:
{$cat} = cat1, {$id1} = 1, {$id2} = 2, {$arg4} = extravar

Page URL (content property): mypage/mysubpage
If the requested URL is: mypage/mysubpage/1/2/3/4
then the content will match and you will have the following smarty variables:
{$arg2} = 1, {$arg3} = 2, {$arg4} = 3, {$arg5} = 4

Page URL (content property): mypage/-id1/-id2/-id3
If the requested URL is: mypage/mysubpage/1
then the content will match and you will have the following smarty variables:
{$id1} = 1, {$id2} = '', {$id3} = ''

Easy way to use pretty urls. No coding needed.
