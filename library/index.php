<?php

require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Newspaper.php';
require_once 'Library.php';


$library = new Library();


$library->addPublication(
    new Book("Мастер и Маргарита", 1967, "Михаил Булгаков")
);

$library->addPublication(
    new Book("Преступление и наказание", 1866, "Фёдор Достоевский")
);


$library->addPublication(
    new Magazine("Наука и жизнь", 2020, 5, "Ежемесячно")
);


$library->addPublication(
    new Newspaper("Известия", 1917, "Известия")
);

echo "<h2>Все издания библиотеки</h2>";

foreach ($library->getAllPublications() as $publication) {
    echo $publication->getInfo() . "<br>";
}

echo "<h2>Поиск по названию</h2>";

$found = $library->search(title: "Мастер");

foreach ($found as $publication) {
    echo $publication->getInfo() . "<br>";
}

echo "<h2>Поиск по автору</h2>";

$found = $library->search(author: "Достоевский");

foreach ($found as $publication) {
    echo $publication->getInfo() . "<br>";
}

echo "<h2>Поиск по году</h2>";

$found = $library->search(year: 1917);

foreach ($found as $publication) {
    echo $publication->getInfo() . "<br>";
}

echo "<h2>Самое старое издание</h2>";

$oldest = $library->getOldestPublication();

if ($oldest !== null) {
    echo $oldest->getInfo();
}

echo "<h2>Статистика библиотеки</h2>";

echo "Книг: " . $library->countByType(Book::class) . "<br>";
echo "Журналов: " . $library->countByType(Magazine::class) . "<br>";
echo "Газет: " . $library->countByType(Newspaper::class) . "<br>";