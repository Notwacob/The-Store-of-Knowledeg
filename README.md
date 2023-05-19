# The Store of Knowledge

An Online Bookstore that allows users to buy and review books.
Jacob Wilson
Dr. Wang, CS489

## Abstract

The goal of the current project is to build a top-notch online bookstore that gives customers a simple way to buy and rate books. The website will have a user-friendly layout and a substantial and varied book library. Users will be able to sign up, establish profiles, browse books with ease, add them to carts, and make purchases directly from their Amazon carts. The website will also offer readers a special chance to post comments, express their ideas, and rate the books they have read. The project will ensure high responsiveness, security, and scalability through the use of cutting-edge web technologies, leading to an effective and secure online buying experience for book enthusiasts. The site's ease of use will allow for effortless exploration of new titles, purchasing books, and sharing opinions with others, thus making it an indispensable tool for all book lovers.

## Table of Contents

- [Abstract](#abstract)
- [Table of Contents](#table-of-contents)
- [Introduction](#introduction)
- [Design](#design)
	- [Bootstrap](#bootstrap)
- [Website Flow](#website-flow)
- [Tables](#tables)
- [Pages](#pages)
	- [login.php](#login.php)
	- [registration.php](#registration.php)
	- [db.php](#db.php)
	- [auth_session.php](#auth_session.php)
	- [main.php](#main.php)
	- [navbar.php](#navbar.php)
	- [about.php](#about.php)
	- [cart.php](#cart.php)
	- [wishList.php](#wishList.php)
	- [profile.php](#profile.php)
	- [logout.php](#logout.php)
	- [bookSearch.php](#bookSearch.php)
	- [searchOutput.php](#searchOutput.php)
	- [searchApiOutput.php](#searchApiOutput.php)
	- [bookRequest.php](#bookRequest.php)
	- [bookReview.php](#bookReview.php)
	- [admin/showUsers.php](#admin-showUsers.php)
	- [admin/adminRequest.php](#admin-adminRequest.php)
- [Conclusion](#conclusion)
- [Work Cited](#work-cited)

## Introduction

The revolutionary concept we are bringing to the table allows customers to easily browse and purchase books online from a vast array of categories. With the option to register for an account or use the general user account to login, users can seamlessly add their desired books to their basket and submit personalized reviews and ratings. Our ultimate objective is to provide avid book enthusiasts with a practical and straightforward platform for all their book purchases and reviewing needs.

## Design

In order to accomplish the goals proposed in the abstract, the first step was to focus on a secure login feature. The other significant result from research was the creation of a dynamic page which allowed users to add books to their cart and wishlists, and be able to review books. This website was coded with HTML, CSS, JavaScript, PHP, and MySQL. The bootstrap library was used in order to create a responsive website that could be used from a mobile device with good usability. I did research on how online bookstores by looking functioned in order to create a user friendly website. I wanted to combine the great aspects you see from many different online book related websites. These things were done by creating many different MySQL tables to be used throughout the site in many different ways. From a user’s cart and Wishlist to being able to add books from the openlibrary api with a search engine inside the website itself. Finally, a logout feature was incorporated to ensure that no session variables were vulnerable when a user was done.

### Bootstrap

This website uses the CSS and JavaScript library to beautify the website and make the website responsive. According to Brett Gardner in his article talking about responsive web design, he says, “In a blog entry, Marcotte outlined a method for creating fluid layouts … he described responsive design as having three parts[,] a fluid layout that uses a flexible grid …[,] images that work in a flexible context … [, and] media queries, which optimize the design for different viewing contexts and spot-fix bugs that occur at different resolution ranges.” (Gardner 14) This type of design is essential on today's web and what all websites should strive to achieve. To achieve responsive web design on this site the use of bootstrap was implemented as it makes predefined CSS and JavaScript to make responsive web design easier to implement. Bootstrap works off a grid system that is 12 columns in each row. There are five grid tiers, one for each range of devices supported. The five tiers are small, medium, large, extra large, extra extra large, each tier has their own abbreviations they use and they go like this, sm, md, lg, xl, xxl. There is also a final tier that is extra small but this is default.

## Website Flow

When users visit the website they are initially sent to the login page where they can login if they have an account. If they don't have an account they can make their way over to the registration page where they can register for an account and after registering they can login in. After login in they are greeted with a welcome message on our main page where they will see the top books on our site and a navigation to get access to the rest of the website.

![Figure 1: Website Flowchart](https://media.discordapp.net/attachments/1081311787821043805/1109100595136176128/6Lvxm3oAAAAASUVORK5CYII.png?width=895&height=671)
<figcaption>Figure 1: Website Flowchart</figcaption><br><br>

This flowchart shows how the website flows together. Each page is connected to a template navbar that when on each page will use JavaScript to add a class to show which page is active.

## Tables

The initial table created via MYSQL contains important information regarding user login credentials. Upon registration, each user's password is encrypted using the md5 format to guarantee that their accounts remain secure from any unauthorized access, such as hacking. The table is named "users," and we refer to it each time we access the user data. Within this table, each user account is assigned a unique ID number, a display name or username, a password, a first and last name, a login count, and the date and time of their most recent login.

![Figure 2: users table](https://media.discordapp.net/attachments/1081311787821043805/1109102334895730719/B2dWawURHhkFCiI3h9eXDDdmTPM4ShlMLFyZ4g1HNbXMdO5KBu1bjQERkNgNARGQ2A0BEZDYDQEqBsCALsycpRzfERkAAAAAElFTkSuQmCC.png)
<figcaption>Figure 2: users table</figcaption><br><br>

The next table created via MYSQL stores all of the relevant information pertaining to books. This table, aptly named "bookList," is home to a comprehensive list of each book's details, including a unique record number and works ID, the book's title, author's name, initial publication year, edition number, rating score, and total number of ratings received.

![Figure 3: bookList Table](https://media.discordapp.net/attachments/1081311787821043805/1109102335235457134/wHTdjPWuf6kjQAAAABJRU5ErkJggg.png)
<figcaption>Figure 3: bookList Table</figcaption><br><br>

Another MYSQL table is dedicated to storing information about each user's cart. Aptly named "cart," this table is where we keep track of the user's username, the title and author's name of each book added to the cart, and the corresponding quantity of each book.

![Figure 4: cart Table](https://media.discordapp.net/attachments/1081311787821043805/1109102335516487691/tAAAAAElFTkSuQmCC.png)
<figcaption>Figure 4: cart Table</figcaption><br><br>

The last MYSQL table is dedicated to storing each user's personal book wishlist. Appropriately named "wishlist," this table contains columns for the user's username, the title and author's name of each book added to the wishlist, and the corresponding quantity of each book.

![Figure 5: wishList Table](https://media.discordapp.net/attachments/1081311787821043805/1109102335810076782/wdmCm6ZW2HcagAAAABJRU5ErkJggg.png)
<figcaption>Figure 5: wishList Table</figcaption><br><br>

## Pages

### login.php

![Figure 6: Login Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109106935992701032/image.png)
<figcaption>Figure 6: Login Page</figcaption><br><br>

When you visit our Online Bookstore for the first time, you will be greeted by the login page. Here, you can either log in to your existing account or create a new one by clicking the click to register link. To log in, simply provide your username and password in the form provided on the page.

After entering your login details, our system will validate the information you have provided. If you have forgotten to enter either your username or password, we will notify you that both are required. If the username you have entered does not match what we have in our database, we will inform you that your username is incorrect. Similarly, if the password you have entered does not match what we have on record, we will notify you that your password is incorrect. In the event that any of these errors occur, we will give you the opportunity to re-enter your login details so that you can access your account.

### registration.php

![Figure 7: Registration Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109107304084811847/image.png)
<figcaption>Figure 7: Registration Page</figcaption><br><br>

On the Registration page users will be able to register for an account on the site they will need to enter a username, password, and first and last name. When they click the registration button they will either receive an error message stating that information was not entered correctly or that their account has been registered correctly and redirect them to the login page.

### db.php

Including the following section of code in any page where database access is necessary is essential since it establishes the connection between the client and server. This code acts as a bridge between the user's browser and the database, allowing the server to retrieve or store data requested by the user. Without this code, the user would not be able to access or modify the database, rendering the system non-functional. Therefore, it's vital to include this code on any page that requires database access to ensure the smooth functioning of the system.

### auth_session.php

This code section is an essential component of the user authentication system, present on every page to ensure that users are authorized to access the content. Its primary function is to authenticate whether a user has logged in or not, redirecting them back to the login page if they haven't. This ensures that only authorized users can access the protected pages of the system, providing an extra layer of security against unauthorized access.

### main.php
Upon successfully logging in, the user will be directed to the website's main page, which features an eye-catching cover image and a personalized welcome message using the first and last name provided during registration. As the user navigates down the page, they will come across the site's navigation bar, which we will discuss in more detail later on. In addition to this, the main page displays the top 16 highest-rated books from our extensive collection, allowing users to quickly and easily discover new reads. Overall, the main page serves as a welcoming and user-friendly hub that provides a glimpse into the website's vast offerings, encouraging users to further explore the site.

![Figure 8: main page cover image and welcome message.](https://media.discordapp.net/attachments/1081311787821043805/1109108160637194280/image.png)
<figcaption>Figure 8: main page cover image and welcome message.</figcaption><br><br>

![Figure 9: main page top book layout](https://cdn.discordapp.com/attachments/1081311787821043805/1109108160985305238/image.png)
<figcaption>Figure 9: main page top book layout</figcaption><br><br>

### navbar.php

The site's navigation is a crucial component of the site access, included on every page. It enables users to navigate the site quickly and easily, with the active pages highlighted to show which page they are currently on. Whether browsing on a larger display or a smaller one, the site's navigation bar remains accessible, adapting to display a hamburger menu on smaller screens.

For those with admin user account type, a drop-down menu appears, giving them access to additional features. This admin drop-down menu provides an efficient way for admins to manage the site's content and user accounts, improving their workflow and ensuring that the site runs smoothly.

![Figure 10: Site Navigation](https://media.discordapp.net/attachments/1081311787821043805/1109108725605732402/image1.png)
<figcaption>Figure 10: Site Navigation</figcaption><br><br>

![Figure 11: Hamburger Menu](https://media.discordapp.net/attachments/1081311787821043805/1109108725828026429/image2.png)
<figcaption>Figure 11: Hamburger Menu</figcaption><br><br>

![Figure 12: Hamburger Menu Dropdown](https://media.discordapp.net/attachments/1081311787821043805/1109108726062923806/image3.png)
<figcaption>Figure 12: Hamburger Menu Dropdown</figcaption><br><br>

![Figure 13: Admin Site Navigation](https://media.discordapp.net/attachments/1081311787821043805/1109108726297792582/image4.png)
<figcaption>Figure 13: Admin Site Navigation</figcaption><br><br>

### about.php

"The Store of Knowledge" is a book retailer passionate about books, personal growth, learning, and enjoyment. Their "About Us" page showcases information about the spurious company surrounding the site, including their mission statement and the significance of the site to their fictitious team. The store offers a wide range of books, covering various genres and subjects, curated by experienced and knowledgeable book-lovers. They provide competitive prices, fast shipping, and different formats of books, including physical books, eBooks, and audiobooks. The store also places a strong emphasis on exceptional customer service, with a friendly and knowledgeable team always ready to assist customers.

![Figure 14: About Us Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109109312019775518/image.png)
<figcaption>Figure 14: About Us Page</figcaption><br><br>

### cart.php
The cart page on this e-commerce website displays the cart information of the user's selected items before proceeding to checkout. It includes the book cover, title, author, and the quantity of each book in the cart. In addition, there are three buttons for each book in the cart. The first button increases the quantity of that book, the second button decreases the quantity of that book until zero, where the book will be removed from the cart. Finally, there is a button to remove all of that book from the cart. Along with the product information, the cart page also displays the total number of books within the cart. The cart page has a clear call to action button that prompts users to proceed to checkout and complete their purchase. When this button is clicked it moves the users to an amazon cart with their desired books. It is important for the cart page to be user-friendly and intuitive to ensure that customers have a seamless and hassle-free shopping experience.

![Figure 15: Cart Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109109606262767656/image.png)
<figcaption>Figure 15: Cart Page</figcaption><br><br>

### wishList.php

The wishList page is a useful feature that enables users to keep track of the books they want to read. It displays the cover of the book, the title of the book, and the author's name for each book in the user's wish list. Additionally, users can remove a book from their wish list by clicking the delete button, which is available for each book displayed.

![Figure 16: Wishlists page](https://cdn.discordapp.com/attachments/1081311787821043805/1109109852824940604/image.png)
<figcaption>Figure 16: Wishlists page</figcaption><br><br>

### profile.php

The profile page is a user-friendly feature that pops up as a modal from the bootstrap library when clicked, allowing users to edit their profile information easily. They can change various details such as their username, password, first name, and last name. Once they've made their desired changes, they can click "save" to confirm their new profile details. This simple and intuitive interface makes it easy for users to customize their account to their liking, without the need for technical expertise or lengthy tutorials.

![Figure 17: Profile Modal](https://cdn.discordapp.com/attachments/1081311787821043805/1109110678645657760/image.png)
<figcaption>Figure 17: Profile Modal</figcaption><br><br>

![Figure 18: Profile Modal after hitting “Edit Profile” button](https://cdn.discordapp.com/attachments/1081311787821043805/1109115489277448202/fix_1.jpg)
<figcaption>
	Figure 18: Profile Modal after hitting “Edit Profile” button<br>
	*Personal information blocked out in this screenshot
</figcaption><br><br>

### logout.php

The logout page is a straightforward feature of the user management system. As the name suggests, it does precisely what it implies: logs the user out and terminates the session. This is an essential step in maintaining the security and integrity of the system. Once a user logs out, their session data is destroyed, and they can no longer access any pages or features that require authentication until they log in again. By ending the session, the logout page also ensures that any sensitive user data, such as their login credentials, are not accessible to anyone who may access the system after the user has logged out. Overall, the logout page is a crucial component of the user management system, contributing to the system's overall security and helping to protect user data.

### bookSearch.php

Included in the navbar.php page is a section of code that enables users to search our extensive database of books for the title they are seeking. With this feature, users can quickly and easily locate their desired book by entering the title into the search bar, saving them valuable time and effort. This search function provides a seamless experience for our users, enhancing their overall satisfaction with our website and making it easier for them to find what they're looking for.

![Figure 19: The website’s search form](https://cdn.discordapp.com/attachments/1081311787821043805/1109116116485275668/image.png)
<figcaption>Figure 19: The website’s search form</figcaption><br><br>

### searchOutput.php

The search output page will take a string put into the navbar’s search box and search our database for all of the books titles and authors that match that word. For example, when you search for the word “good” the screenshot below shows which books have that word in their title or as an author. At the time the screenshot was taken there were only two results in our database from that search. If the users can not find the book they were looking for within our database at the bottom of the table there is a form where they can enter the name of the book they want and it will display the results from the openlibrary Api.

![Figure 20: Search Output Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109116347088109658/image.png)
<figcaption>Figure 20: Search Output Page</figcaption><br><br>

### searchApiOutput.php

The search API output page is a helpful tool for users who can't find the book they're looking for in our database. By searching the openlibrary API, they can get access to additional results directly on our site. When searching for a common word like "good," the API returns a large number of results. To keep things efficient and quick, we limit the number of results shown to the top 50. If a user still can't find what they're looking for, they may need to dig deeper and refine their search further. The screenshot of the search results for "good" provides a clear example of the kind of output users can expect when using this feature.

![Figure 21: Search Api Output Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109116574306144286/image.png)
<figcaption>Figure 21: Search Api Output Page</figcaption><br><br>

### bookRequest.php

The book request page is a vital feature that manages all book-related requests, including adding a new book to our database when one of the three buttons on the search API output page is clicked. These three buttons are Add to Cart, Add to List, and Review Book.

When a user clicks the Add to Cart button, the book is added to our database and subsequently added to the cart. Alternatively, if the book is already in our database, it will be directly added to the cart. Similarly, when the Add to List button is clicked, the book is either first added to our database and then added to the wishlist or directly added to the wishlist if it's already in our database. Finally, when the Review Book button is clicked, the book is either first added to our database and then the user is redirected to the book review page, or the user is directly redirected to the book review page if the book is already in our database.

![Figure 22: The Three Buttons](https://cdn.discordapp.com/attachments/1081311787821043805/1109116813947699221/image.png)
<figcaption>Figure 22: The Three Buttons</figcaption><br><br>

### bookReview.php

If a user wants to give a particular book a rating, they can click the "review book" button, which will redirect them to a dedicated page. On this page, they can rate the book on a scale of 0.5 to 5 stars. Once they have given the book a rating, they can click the "submit" button, which will take them to the action page.

On the action page, the system will update the book's rating and total number of ratings in the bookList table, reflecting the user's review. After the update is complete, the user will be redirected back to the home page. This process is straightforward and efficient, allowing users to give books a rating and share their thoughts quickly and easily.

![Figure 23: Book Review Page ](https://cdn.discordapp.com/attachments/1081311787821043805/1109117128214323331/image.png)
<figcaption>Figure 23: Book Review Page</figcaption><br><br> 

<h3 id="admin-showUsers.php">admin/showUsers.php</h3>

The "show users" page is an essential feature of the user management system, displaying a list of all the users in the system, along with their relevant information, such as their username, user's name, account type, password hash, the number of times they've logged in, and the last time they logged in. Each user's information is accompanied by three buttons, which are linked to their account: "change user type," "change password," and "delete user."

When an admin clicks one of these buttons, a request is triggered, which goes through an action page called "adminRequest.php." However, only those with the admin user account type can access this page, ensuring that only authorized users can make changes to user accounts.

The "change user type" button allows the admin to change a user's account type, such as upgrading a regular user to an admin. Clicking the "change password" button generates a form that enables the admin to reset the user's password securely. Finally, the "delete user" button permits the admin to remove the user account entirely from the system.

![Figure 24: Show User Page](https://cdn.discordapp.com/attachments/1081311787821043805/1109117440358621254/image.png)
<figcaption>Figure 24: Show User Page</figcaption><br><br>

<h3 id="admin-adminRequest.php">admin/adminRequest.php</h3>

The adminRequest.php page is an important part of the user management system, handling requests made when the "change user type," "change password," or "delete user" buttons are clicked on the "show users" page. When the admin clicks the "change password" button, the page generates a form for them to enter a new password for the user. This process ensures that the password is updated securely, with no errors or unauthorized access.

## Conclusion

In concussion this site is a user-friendly way for book lovers to find and rate books and this project was a great way for me to think more outside the box with ideas and not just to go for easy robust projects but to make this website something that I would be happy to put on my portfolio. This project jumps deep into responsive web design and how it can be very impactful for users to experience an easy to use site for everyday use. This is a key factory as to why amazon is so successful because of its user-friendliness and it was the key factory that was in my head when designing this site.

## Works Cited

http://zeus.vwu.edu/~jawilson/CS_489/

Gardner, Brett S. "Responsive web design: Enriching the user experience." Sigma Journal: Inside the Digital Ecosystem 11.1 (2011): 13-19.

Thornton, Jacob, and Mark Otto. “Bootstrap.” Bootstrap · The Most Popular HTML, CSS, and JS Library in the World., [https://getbootstrap.com/](https://getbootstrap.com/).

Wang, Zizhong John. “Web Programmming with PHP/MYSQL” Virginia Wesleyan University, 2020.

"Stack Overflow." Stack Overflow. Web. 23 Apr. 2015.
