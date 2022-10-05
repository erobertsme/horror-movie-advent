# 👻 Horror Movie Advent 🎃
This is a small set of PHP pages to display and allow easy editing of a Horror movie advent calendar.

Theme is based on [Dracula Theme](https://draculatheme.com) 🧛🏻‍♂️.

Index page is made to avoid using JS.

---
### How to use
Basic common sense is required. I don't really want to write out each detail on how to use such a simple set of pages.

Upload files to any directory you'd like on a PHP compatible server.

Copy `options.sample.php` to `options.php` and set the password constant.

To view the list users will navigate to the base directory the files were uploaded to.

To edit the list users will navigate to `/edit.php` of the base directory the files were uploaded to, and must use the password defined in the constant in `options.php`. Each section is set to `contenteditable` to maintain the same layout and look in order to make it easier to find the line you want to edit.

---
#### TODO
- Change tooltip to accordion style details panel that opens below selection to allow more information and add details like movie description, rating, image, language, et al
- Simplify CSS and change colors to variables to allow easy re-styling
- Add emojis to variables to allow easy re-styling
- Add notification after saving using status URI query var
- Add data validation on save