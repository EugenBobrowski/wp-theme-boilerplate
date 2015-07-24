<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 9/11/14
 * Time: 6:12 PM
 */
function getOptionsArray() {
    return array (
        'general' => array(
            'name' => 'General Settings',
            'desc' => __('General settings'),

            'items' => array(
                'favicon' => array(
                    'type' => 'addMedia',
                    'title' => __('Favicon', 'atf'),
                    'default' => get_template_directory_uri().'/img/favicon.png',
                    'desc' => 'The optimal size for an image is 16x16'
                ),
                'logo' => array(
                    'type' => 'addMedia',
                    'title' => __('Header Logotype image', 'atf'),
                    'default' => get_template_directory_uri().'/img/logo.png',
                ),
                'logo_link' => array(
                    'type' => 'textField',
                    'title' => 'Ссылка логотипа',
                    'default' => 'http://aov.ru',
                    'desc' => 'Оставьте єто поле пустым, если хотите чтобы сайт ссылался на главную.',
                ),

            ),
        ),
        'header' => array(
            'name' => 'Header Settings',
            'desc' => 'Изменить настройки шапки',

            'items' => array(
                'lead_text' => array(
                    'type' => 'textarea',
                    'title' => 'Заголовок',
                    'default' => 'Как издать книгу '.PHP_EOL
                        .'недорого?',
                ),

                'steps_list' => array(
                    'type' => 'textarea',
                    'title' => 'Шаги',
                    'default' => 'Создайте книгу'.PHP_EOL
                        .'Подтвердите заявку'.PHP_EOL
                        .'Книга издана',
                    'desc' => __('One line one list item', 'atf'),
                ),
                'cert' => array(
                    'type' => 'addMedia',
                    'title' => __('Сертификат', 'atf'),
                    'default' => get_template_directory_uri().'/img/certif-example.jpg',
                ),
            ),
        ),
        'constructor' => array(
            'name' => 'Constructor Settings',
            'desc' => 'Настройки конструктора и конструктор расчета',

            'items' => array(
                'title' => array(
                    'type' => 'textField',
                    'title' => 'Заголовок',
                    'default' => 'он-лайн конструктор',
                ),
                'construct_model_text' => array(
                    'type' => 'textField',
                    'title' => 'Сконструировать макет книги',
                    'default' => 'Сконструировать макет книги',
                ),
                'order_model_text' => array(
                    'type' => 'textField',
                    'title' => 'Заказать эксклюзивный макет у дизайнера ',
                    'default' => 'Заказать эксклюзивный макет у дизайнера ',
                ),
                'close_constructor' => array(
                    'type' => 'textField',
                    'title' => 'Текст закрытия конструктора',
                    'default' => 'Выйти из конструктора',
                ),
                array(
                    'type' => 'title',
                    'title' => 'Вид по умолчанию',
                ),
                'default_view_title' => array(
                    'type' => 'textField',
                    'title' => 'Заголовок',
                    'default' => 'конструктор поможет:',
                ),
                'default_view_items' => array(
                    'type' => 'textarea',
                    'title' => 'Что поможет конструктор',
                    'default' => 'создать'.PHP_EOL
                        .'макет издания'.PHP_EOL.PHP_EOL
                        .'загрузить ваши'.PHP_EOL
                        .'материалы'.PHP_EOL.PHP_EOL
                        .'Рассчитать'.PHP_EOL
                        .'стоимость',
                    'desc' => __('One line one list item', 'atf'),
                ),

                array(
                    'type' => 'title',
                    'title' => 'Настройки конструктора',
                ),
                'default_papers_format' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_format',
                    'title' => 'Формат по умолчанию',
                    'hide_empty' => false,
                    'default' => 16,
                    'desc' => __('Формат отмеченный по умолчанию. Добавить или изменить можно <a href="edit-tags.php?taxonomy=book_format&post_type=order">здесь</a>. Шаблон именования: "Название Ширина Висота"', 'atf'),
                ),
                'default_papers_format_hierarchical' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_format',
                    'title' => 'Формат по умолчанию',
                    'hide_empty' => false,
                    'default' => 53,
                    'desc' => __('Формат отмеченный по умолчанию. Добавить или изменить можно <a href="edit-tags.php?taxonomy=book_format&post_type=order">здесь</a>. Можно выберать форматы только с определенной ориентацией.', 'atf'),
                ),
                'default_papers_orientation' => array(
                    'type' => 'onOffBox',
                    'title' => 'Книжная ориентация по умолчанию',
                    'default' => false,
                    'desc' => __('', 'atf'),
                ),
                'default_template' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_templates',
                    'title' => 'Шаблон по умолчанию',
                    'hide_empty' => false,
                    'default' => 18,
                    'desc' => __('Добавить можно <a href="edit-tags.php?taxonomy=book_templates&post_type=orders">здесь</a>. Жанр добавить можно <a href="edit-tags.php?taxonomy=book_genre&post_type=order">здесь</a>', 'atf'),
                ),
                'default_paper_type' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_paper_type',
                    'title' => 'Тип бумаги по умолчанию',
                    'hide_empty' => false,
                    'default' => 31,
                    'desc' => __('Добавить, удалить, установить стоимость можно <a href="edit-tags.php?taxonomy=book_paper_type&post_type=orders">здесь</a> ', 'atf'),
                ),
                'default_paper_type_face' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_paper_type',
                    'title' => 'Тип бумаги обложки для расчета',
                    'hide_empty' => false,
                    'default' => 39,
                    'desc' => __('Добавить, удалить, установить стоимость можно <a href="edit-tags.php?taxonomy=book_paper_type&post_type=orders">здесь</a> ', 'atf'),
                ),
//                'face_double_side_print' => array(
//                    'type' => 'onOffBox',
//                    'title' => 'Двусторонняя пучать на обложке',
//                    'default' => '1',
//                    'desc' => __('', 'atf'),
//                ),

                'default_book_facing' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_facing',
                    'title' => 'Отделка по умолчанию',
                    'hide_empty' => false,
                    'default' => 32,
                    'desc' => __('Добавить можно <a href="edit-tags.php?taxonomy=book_facing&post_type=orders">здесь</a>', 'atf'),
                ),
                'default_book_binding' => array(
                    'type' => 'selectFromTaxonomy',
                    'taxonomy' => 'book_binding',
                    'title' => 'Скрепление по умолчанию',
                    'hide_empty' => false,
                    'default' => 35,
                    'desc' => __('Добавить можно <a href="edit-tags.php?taxonomy=book_binding&post_type=orders">здесь</a>', 'atf'),
                ),
                'publisher_pac_text' => array(
                    'type' => 'textArea',
                    'title' => 'Текст о издательском пакете',
                    'default' => 'В издательский пакет входит предоставление ISBN, присвоение УДК и ББК,
знак защиты авторских прав. В соответствии с Федеральным Законом
“Об обязательном экземпляре документов”, 16 экземпляров книги передается
в Российскую книжную палату и рассылается в главные библиотеки страны.',
                ),
                'publisher_pac_default' => array(
                    'type' => 'onOffBox',
                    'title' => 'Издательский пакет по умолчанию',
                    'default' => '0',
                ),
                'publisher_pac_cost' => array(
                    'type' => 'textField',
                    'title' => 'Стоимость издательского пакета умолчанию',
                    'default' => '3000',
                ),
                'default_pages_num' => array(
                    'type' => 'textField',
                    'title' => 'Количество страниц по умолчанию',
                    'default' => '501',
                ),
                'default_printing' => array(
                    'type' => 'textField',
                    'title' => 'Тираж по умолчанию',
                    'default' => '100',
                ),
                'max_printing' => array(
                    'type' => 'textField',
                    'title' => 'Максимальный тираж',
                    'default' => '105',
                ),
                'min_printing' => array(
                    'type' => 'textField',
                    'title' => 'Минимальный тираж',
                    'default' => '5',
                ),
                'print_act_price_gray' => array(
                    'type' => 'textArea',
                    'title' => 'Градация цены за прогон A4 (ч/б)',
                    'default' => '0 4'.PHP_EOL
                        .'5 3'.PHP_EOL
                        .'10 1.4'.PHP_EOL
                        .'20 1'.PHP_EOL
                        .'50 0.8'.PHP_EOL
                        .'100 0.7'.PHP_EOL
                        .'300 0.6',
                    'desc' => __('Тираж от - цена за  прогон A4', 'atf'),
                ),
                'print_act_price_color' => array(
                    'type' => 'textArea',
                    'title' => 'Градация цены за прогон A3 (цветная)',
                    'default' => '0 20'.PHP_EOL
                        .'11 14'.PHP_EOL
                        .'50 12'.PHP_EOL
                        .'100 10'.PHP_EOL
                        .'200 9'.PHP_EOL
                        .'300 8'.PHP_EOL
                        .'1000 7',
                    'desc' => __('Прогонов от - цена за прогон A3', 'atf'),
                ),
                'colorPrint' => array(
                    'type' => 'onOffBox',
                    'title' => 'Цветная печать по молчанию',
                    'default' => '0',
                    'desc' => __('', 'atf'),
                ),
                'colorPrint_img' => array(
                    'type' => 'addMedia',
                    'title' => __('Изображение на цветную печать', 'atf'),
                    'default' => get_template_directory_uri().'/img/painting_color.gif',
                ),
                'grayPrint_img' => array(
                    'type' => 'addMedia',
                    'title' => __('Изображение на ч/б печать', 'atf'),
                    'default' => get_template_directory_uri().'/img/painting_gray.gif',
                ),
                'profit_price_up' => array(
                    'type' => 'textArea',
                    'title' => 'Наценка',
                    'default' => '0 +1500'.PHP_EOL
                        .'3000 *1.75'.PHP_EOL
                        .'10000 *1.5'.PHP_EOL
                        .'20000 *1.25',
                    'desc' => __('"Себестоимость более" поправка. Поправка либо добавляет к себестоимости наценку, либо умножает на коэфициент', 'atf'),                ),
                'price_desc_constructor' => array(
                    'type' => 'textField',
                    'title' => 'Примечание к цене при конструировании макета',
                    'default' => 'Цена не включает в себя работы по предпечатной подготовке',
                ),
                'price_desc_design' => array(
                    'type' => 'textField',
                    'title' => 'Примечание к цене при заказе макета у дизайнера ',
                    'default' => 'Цена не включает в себя работы по предпечатной подготовке и разработке дизайна',
                ),
                'non_calc_binding_text' => array(
                    'type' => 'textField',
                    'title' => 'Текст при выборе не калькулируемого скреплениея',
                    'default' => 'При выборе данного скрепления сумму заказа расчитывает наш менеджер',
                    'desc' => 'Выводится при выборе скрепления для которого не предусмотрен расчет'
                ),
                'non_calc_binding_paper_size_text' => array(
                    'type' => 'textField',
                    'title' => 'Текст при выборе А4 и скрепления кроме пружины',
                    'default' => 'Доступно только пружинное скрепление',
                ),
                'non_calc_paiting_type_text' => array(
                    'type' => 'textField',
                    'title' => 'Текст при выборе не совместимой бумаги и цвета печати',
                    'default' => 'Выбраный тип бумаги и цвет печати не совместимы',
                ),
                'printing_is_to_few_notice' => array(
                    'type' => 'textField',
                    'title' => 'Текст при выборе издательского пакета и малого тиража',
                    'default' => 'При выбранном издательском пакете мы должны 16 экземпляров отдать в библиотеки. По этому тираж не должен быть менее 17 екземпляров.',
                ),
                'printing_is_min_notice' => array(
                    'type' => 'textField',
                    'title' => 'Текст при выборе тиража меньшего чем минимальный',
                    'default' => 'Тираж слишком мал',
                ),
                'printing_is_max_notice' => array(
                    'type' => 'textField',
                    'title' => 'Текст при выборе тиража большего чем максимальный',
                    'default' => 'Тираж слишком велик чтобы считать стоимость без учета скидки. Оставьте заявку и менеджер свяжется с Вами.',
                ),

                'author_photo_upload_notice' => array(
                    'type' => 'textField',
                    'title' => 'Примечание к выбору фото автора',
                    'default' => 'Объем файла желательно не менее 600кБ.',
                ),


//
//                array(
//                    'type' => 'title',
//                    'title' => 'Настройки валюты',
//                ),
//                'unit_cost' => array(
//                    'type' => 'text',
//                    'title' => 'Стоимость единиц указанных в стоимостях различных опций',
//                    'default' => '1',
//                    'desc'  => 'Для рубля она ровняется 1.',
//                ),


            ),
        ),
        'reference' => array(
            'name' => 'Reference Settings',
            'desc' => 'Недавно изданные книги',

            'items' => array(
                'title' => array(
                    'type' => 'textField',
                    'title' => 'Заголовок',
                    'default' => 'Недавно изданные книги',
                ),
                'slide_interval' => array(
                    'type' => 'textField',
                    'title' => 'Интервал в секундах',
                    'default' => 600,
                ),
                'pro_slide' => array(
                    'type' => 'textField',
                    'title' => 'Кол-во на 1 слайд',
                    'default' => 4,
                ),
                'max_slides' => array(
                    'type' => 'textField',
                    'title' => 'Кол-во слайдов',
                    'default' => 4,
                ),
            ),
        ),
        'testimonials' => array(
            'name' => 'Testimonials Settings',
            'desc' => 'Отзывы',

            'items' => array(
                'title' => array(
                    'type' => 'textField',
                    'title' => 'Заголовок',
                    'default' => 'отзывы наших клиентов',
                ),
                'slide_interval' => array(
                    'type' => 'textField',
                    'title' => 'Интервал в секундах',
                    'default' => 60,
                ),
                'max_slides' => array(
                    'type' => 'textField',
                    'title' => 'Кол-во слайдов',
                    'default' => 4,
                ),
            ),
        ),
        'motivation' => array(
            'name' => 'Motivation Block Settings',
            'desc' => 'Мотивационный блок',

            'items' => array(
                'top' => array(
                    'type' => 'textarea',
                    'title' => 'Верхний текст',
                    'default' => 'Издательский процесс  может быть увлекательным и приятным занятием.'.PHP_EOL
                        .PHP_EOL
                        .'Мы упростили и автоматизировали все стадии'.PHP_EOL
                        .'от текста до тиража.',
                ),
                'h1' => array(
                    'type' => 'textarea',
                    'title' => 'Заголовок',
                    'default' => 'Превратите вашу идею'.PHP_EOL
                        .'в великолепное издание',
                ),
                'bottom_link_text' => array(
                    'type' => 'textField',
                    'title' => 'Текст ссылки внизу',
                    'default' => 'Как издать книгу и сколько это стоит?',
                ),
//                'bottom_link_href' => array(
//                    'type' => 'textField',
//                    'title' => 'Адрес на который ведет ссылка',
//                    'default' => 'http://aov.ru/ddd'
//                ),
            ),
        ),
        'clients' => array(
            'name' => 'Clients Settings',
            'desc' => 'У нас издают книги',

            'items' => array(
                'title' => array(
                    'type' => 'textField',
                    'title' => 'Заголовок',
                    'default' => 'у нас издают книги',
                ),
            ),
        ),
        'contacts' => array(
            'name' => 'Contact Settings',
            'desc' => __('Настройки контактов'),

            'items' => array(
                'title' => array(
                    'type' => 'textField',
                    'title' => __('Заголовок', 'atf'),
                    'default' => 'Контакты',
                    'desc' => __('Номера телефонов через запятую', 'atf'),
                ),
                'phones' => array(
                    'type' => 'textField',
                    'title' => __('Телефоны', 'atf'),
                    'default' => '+7(495) 770–3659, +7(495) 770–3660',
                    'desc' => __('Номера телефонов через запятую', 'atf'),
                ),
                'phones_footer' => array(
                    'type' => 'textField',
                    'title' => __('Телефоны в футере', 'atf'),
                    'default' => '(495) 770–3659, (495) 770–3660',
                    'desc' => __('Номера телефонов через запятую для футера', 'atf'),
                ),
                'working_time' => array(
                    'type' => 'textField',
                    'title' => __('Режим работы', 'atf'),
                    'default' => 'Пн.-Пт.  9:00 – 17:30',
                ),
                'email' => array(
                    'type' => 'textField',
                    'title' => __('E-mail', 'atf'),
                    'default' => 'om@aov.ru',
                ),
                'address' => array(
                    'type' => 'textarea',
                    'title' => __('Адресс', 'atf'),
                    'default' => 'г. Москва, м. Шаболовская, '.PHP_EOL
                        .'Ленинский проспект, д. 19, стр.1',
                ),
                'map' => array(
                    'type' => 'addMedia',
                    'title' => 'Картинка карты',
                    'default' => get_template_directory_uri().'/img/footer-map.png',
                ),
                'order_call_mail' => array(
                    'type' => 'textField',
                    'title' => __('E-mail для отправки заказанных звонков и уведомления о заказах', 'atf'),
                    'default' => 'ecologistkai@gmail.com',
                ),
                'order_call_subject' => array(
                    'type' => 'textField',
                    'title' => __('Тема письма', 'atf'),
                    'default' => 'Заказан звонок на сайте',
                ),
                'call_from_site' => array(
                    'type' => 'textField',
                    'title' => __('Номер для звонка с сайта', 'atf'),
                    'default' => '245057',
                    'desc' => __('Предоставляется zadarma.com<br> Рабочий номер - 20019 (взят с сайта Store.ru)', 'atf'),
                ),
                'img_call_us' => array(
                    'type' => 'addMedia',
                    'title' => __('Кнопка "Позвонить Нам"', 'atf'),
//                    'default' => '//zadarma.com/images/but/call2_red_ru_free.png',
                    'default' => get_template_directory_uri().'/img/call-norm-128.png',
                    'desc' => 'размер кнопок должен быть одинаковым и не может быть меньше 215 на 138 пикселей, это связано с ограничениями flash',
                ),
                'img_call_connection' => array(
                    'type' => 'addMedia',
                    'title' => __('Кнопка "Соединение"', 'atf'),
//                    'default' => '//zadarma.com/images/but/call2_green_ru_connecting.png',
                    'default' => get_template_directory_uri().'/img/call-norm-connection-128.png',
                    'desc' => 'размер кнопок должен быть одинаковым и не может быть меньше 215 на 138 пикселей, это связано с ограничениями flash',
                ),
                'img_call_reset' => array(
                    'type' => 'addMedia',
                    'title' => __('Кнопка "Закончить звонок"', 'atf'),
//                    'default' => '//zadarma.com/images/but/call2_green_ru_reset.png',
                    'default' => get_template_directory_uri().'/img/call-norm-reset-128.png',
                    'desc' => 'размер кнопок должен быть одинаковым и не может быть меньше 215 на 138 пикселей, это связано с ограничениями flash',
                ),
                'img_call_error' => array(
                    'type' => 'addMedia',
                    'title' => __('Кнопка "Ошибка соединения"', 'atf'),
//                    'default' => '//zadarma.com/images/but/call2_green_ru_error.png',
                    'default' => get_template_directory_uri().'/img/call-norm-error-128.png',
                    'desc' => 'размер кнопок должен быть одинаковым и не может быть меньше 215 на 138 пикселей, это связано с ограничениями flash',
                ),
                /*'chat_code' => array(
                    'type' => 'textarea',
                    'title' => __('Скрипт чата', 'atf'),
                    'default' => "(function() {
		var s = document.createElement('script');
		s.type ='text/javascript';
		s.id = 'supportScript';
		s.charset = 'utf-8';
		s.async = true;
		s.src = '//me-talk.ru/support/support.js?h=628795cf9d55ab5f894903e0958de25d';
		var sc = document.getElementsByTagName('script')[0];

		var callback = function(){

			//	Здесь вы можете вызывать API. Например, чтобы изменить отступ по высоте:
			//	supportAPI.setSupportTop(200);

		};

		s.onreadystatechange = s.onload = function(){
			var state = s.readyState;
			if (!callback.done && (!state || /loaded|complete/.test(state))) {
				callback.done = true;
				callback();
			}
		};

		if (sc) sc.parentNode.insertBefore(s, sc);
		else document.documentElement.firstChild.appendChild(s);
	})();
", */
                    'chat_code' => array(
                    'type' => 'textarea',
                    'title' => __('Скрипт чата', 'atf'),
                    'default' => "",
                    'desc' => 'Вставлять без тегов '.htmlspecialchars('<script></script>'),
                ),

            ),
        ),


    );
}