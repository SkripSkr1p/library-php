
<?php

require_once 'Book.php';
require_once 'Magazine.php';
require_once 'Newspaper.php';
require_once 'Library.php';

// Создаём библиотеку
$library = new Library();

// Главное меню программы
while (true) {

    echo "\n========== БИБЛИОТЕКА ==========\n";
    echo "1. Добавить издание\n";
    echo "2. Просмотреть все издания\n";
    echo "3. Найти издание\n";
    echo "4. Сводная информация\n";
    echo "0. Выход\n";

    echo "\nВыберите действие: ";

    $choice = trim(fgets(STDIN));

    switch ($choice) {

        // Добавление издания
        case '1':

            echo "\nВыберите тип издания:\n";
            echo "1. Книга\n";
            echo "2. Журнал\n";
            echo "3. Газета\n";

            echo "Ваш выбор: ";
            $type = trim(fgets(STDIN));

            echo "Введите название: ";
            $title = trim(fgets(STDIN));

            echo "Введите год выпуска: ";
            $year = (int) trim(fgets(STDIN));

            if ($title === '' || $year <= 0) {
                echo "Ошибка: некорректные данные!\n";
                break;
            }

            if ($type === '1') {

                echo "Введите автора: ";
                $author = trim(fgets(STDIN));

                $publication = new Book($title, $year, $author);

            } elseif ($type === '2') {

                echo "Введите номер выпуска: ";
                $number = (int) trim(fgets(STDIN));

                echo "Введите периодичность: ";
                $periodicity = trim(fgets(STDIN));

                $publication = new Magazine(
                    $title,
                    $year,
                    $number,
                    $periodicity
                );

            } elseif ($type === '3') {

                echo "Введите издательство: ";
                $publisher = trim(fgets(STDIN));

                $publication = new Newspaper(
                    $title,
                    $year,
                    $publisher
                );

            } else {
                echo "Неизвестный тип издания!\n";
                break;
            }

            $library->addPublication($publication);

            echo "Издание успешно добавлено!\n";

            break;

        // Просмотр всех изданий
        case '2':

            $publications = $library->getAllPublications();

            if (empty($publications)) {
                echo "Каталог пуст!\n";
                break;
            }

            echo "\n========== КАТАЛОГ ==========\n";

            foreach ($publications as $index => $publication) {
                echo ($index + 1) . ". ";
                echo $publication->getInfo() . "\n";
            }

            break;

        // Поиск издания
        case '3':

            echo "\nПоиск по:\n";
            echo "1. Названию\n";
            echo "2. Автору\n";
            echo "3. Году выпуска\n";

            echo "Ваш выбор: ";
            $searchType = trim(fgets(STDIN));

            if ($searchType === '1') {

                echo "Введите название: ";
                $value = trim(fgets(STDIN));

                $results = $library->search(title: $value);

            } elseif ($searchType === '2') {

                echo "Введите автора: ";
                $value = trim(fgets(STDIN));

                $results = $library->search(author: $value);

            } elseif ($searchType === '3') {

                echo "Введите год: ";
                $value = (int) trim(fgets(STDIN));

                $results = $library->search(year: $value);

            } else {
                echo "Неизвестный вариант поиска!\n";
                break;
            }

            if (empty($results)) {
                echo "Издания не найдены.\n";
            } else {

                echo "\n========== РЕЗУЛЬТАТЫ ПОИСКА ==========\n";

                foreach ($results as $publication) {
                    echo $publication->getInfo() . "\n";
                }
            }

            break;

        // Сводная информация
        case '4':

            echo "\n========== СТАТИСТИКА ==========\n";

            $all = $library->getAllPublications();

            echo "Всего изданий: " . count($all) . "\n";

            echo "Книг: " .
                $library->countByType(Book::class) . "\n";

            echo "Журналов: " .
                $library->countByType(Magazine::class) . "\n";

            echo "Газет: " .
                $library->countByType(Newspaper::class) . "\n";

            $oldest = $library->getOldestPublication();

            if ($oldest !== null) {
                echo "Самое старое издание: ";
                echo $oldest->getInfo() . "\n";
            } else {
                echo "Каталог пока пуст.\n";
            }

            break;

        // Выход
        case '0':

            echo "Завершение программы...\n";
            exit;

        default:

            echo "Неверный пункт меню!\n";
    }
}
