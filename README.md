# Feedback4U

If you want to use our web site you must have installed docker on your machine.
In this directory open your console and tipe: docker-compose up --build -d

Login:
Admin:
-Email: adminfeedback4u@feedback4u.it
-Password: feedback4upassword

To try the student functions you must register and then to add votes you need
to go to the db in the container and in exec page you need to enter in mysql console,
use feedback4u and paste this in the console:
"insert into votes (vote, idUser, idSubject, date) values (9, 2, 1,"2023-10-25");"

Now your newly registered user has a vote on a subject and you can add feedbacks to the subject.
