<h1>Covid eigen verklaring writer</h1>

<hr>

<h3>Dependencies</h3>

To download the required dependencies you will need Composer

Then execute the following command in the project

`php composer.phar install`

<h3>Credentials</h3>

The database and email credentials are controlled by an .env file

<h3>Database</h3>

There is an sql dump in the files that can be used for the login and for the document signer

<h3>Mail</h3>
Any SMTP mail can be used

The PDF will be sent to the email that the user registered with

<h3>Output</h3>
When the file get generated it will be saved on the server and currently will not be deleted automatically

The file can be downloaded or emailed to the user

