$(function () {
  //=============== Обработчик кнопи выбора количества отображаемых товаров каталога (Выпуск №134) ===================//

  $(".qtyitems a").on("click", function (e) {
    e.preventDefault();

    let qty = +$(this).text();

    if (qty && !isNaN(qty)) {
      $(this).closest(".pagination__count").children("span").html(qty);

      $.ajax({
        url: "/",

        data: {
          qty: qty,

          ajax: "catalog_quantities",
        },
      });

      // после выбора кол-ва отображаемых товаров на странице каталога, запустим перезагрузку страницы (+Выпуск №136)
      setTimeout(() => {
        location.href = location.pathname;
      }, 100);
    }
  });
});

/* ================================================== Ajax-js =========================================================== */

// опишем объект, который будет отвечать за отправку асинхронных запросов (~ Выпуск №68)
//  и объявим стрелочную ф-ию, в которую будет приходить объект настроек: set
// (в стрелочной ф-ии ключевому слову: this не доступен указатель на контекст(на объект)
// (в стрелочной ф-ии this будет искать ближайший контекст, который ему доступен (здесь- это объект: Window)))

/**
 * Объект, который будет отвечать за отправку асинхронных запросов
 *
 * (На вход: объект настроек: set)
 */
const Ajax = (set) => {
  if (typeof set === "undefined") set = {};

  if (typeof set.url === "undefined" || !set.url) {
    set.url = typeof PATH !== "undefined" ? PATH : "/";
  }

  // +Выпуск №95
  if (typeof set.ajax === "undefined") {
    set.ajax = true;
  }

  if (typeof set.type === "undefined" || !set.type) set.type = "GET";

  set.type = set.type.toUpperCase();

  // Сформируем строку для тела запроса:

  let body = "";

  if (typeof set.data !== "undefined" && set.data) {
    // +Выпуск №95
    if (typeof set.processData !== "undefined" && !set.processData) {
      body = set.data;
    } else {
      for (let i in set.data) {
        if (set.data.hasOwnProperty(i)) {
          body += "&" + i + "=" + set.data[i];
        }
      }

      body = body.substr(1);

      if (typeof ADMIN_MODE !== "undefined") {
        body += body ? "&" : "";

        body += "ADMIN_MODE=" + ADMIN_MODE;
      }
    }
  }

  if (set.type === "GET") {
    set.url += "?" + body;
    body = null;
  }

  return new Promise((resolve, reject) => {
    // инициализируем новый обьект: XMLHttpRequest:

    /**
     * обьект: XMLHttpRequest
     */
    let xhr = new XMLHttpRequest();

    // откроем соединение и далее его настраиваем
    // на вход методу: open() 1- тип соединения, 2- адрес, 3-ий не обязательный параметр по умолчанию соединение- асинхронное, т.е. true
    xhr.open(set.type, set.url, true);

    // после открытия соединения сделаем базовые настройки соединения:

    // св-во заголовков
    let contentType = false;

    if (typeof set.headers !== "undefined" && set.headers) {
      for (let i in set.headers) {
        //+Выпуск №95
        if (set.headers.hasOwnProperty(i)) {
          // установим заголовки для объекта: XMLHttpRequest На вход принимает: 1- имя заголока, 2-значение заголовка
          xhr.setRequestHeader(i, set.headers[i]);

          if (i.toLowerCase() === "content-type") contentType = true;
        }
      }
    }

    // +выпуск №95
    if (
      !contentType &&
      (typeof set.contentType === "undefined" || set.contentType)
    )
      xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded; charset=UTF-8",
      );

    // +выпуск №95
    if (set.ajax)
      // сформируем и отправим заголовок
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    // свойство(событие) у объекта, возникающее в случае успешного ответа от сервера
    xhr.onload = function () {
      if (this.status >= 200 && this.status < 300) {
        // если сервер упал и в качестве ответа от сервера пришло: fatal error
        if (/fatal\s+?error/iu.test(this.response)) {
          // выбросим исключение
          reject(this.response);
        }

        // т.е. получили успешный ответ от сервера
        resolve(this.response);
      }

      // если статус ответа от сервера не находится в допустимом диапазоне- выбросим исключение
      reject(this.response);
    };

    // свойство(событие) у объекта, возникающее в случае неудачного ответа от сервера
    xhr.onerror = function () {
      // выбросим исключение
      reject(this.response);
    };

    // Отправим данные на сервер На вход методу: send() предаём в виде строки, то что находится в переменной: body
    // (для метода: POST) Для метода: GET, body будет равно: null
    xhr.send(body);
  });
};

/* =============================================== поиск ============================================================== */
menuSearch();

// ~ Выпуск №99
// Функция добавляет класс для открытия списка ссылок (результатов поиска) при щелчке на поле поиска
function menuSearch() {
  // Для кнопки поиска в админке (с id = "searchButton") - div внутри которого расположен другой div с изображением поиска):
  let searchBtn = document.querySelector("#searchButton");

  // для полученного в переменную div с id = "searchButton" найдём input type="text"
  let searchInput = searchBtn.querySelector("input[type=text]");

  // на searchBtnCat вешаем событие: click
  searchBtn.addEventListener("click", () => {
    // что бы блок поиска появился, добавим класс: vg-search-reverse при клике
    searchBtn.classList.add("vg-search-reverse");

    // поставим курсор на поле ввода (фокус)
    searchInput.focus();
  });

  // организуем закрытие поиска при потере фокуса (щелчке на другом месте, переключении вкладок): вешаем событие: blur
  searchInput.addEventListener("blur", (e) => {
    // организуем в поиске переход по подсказке (ссылке) при нажатии на неё (Выпуск №113)
    if (e.relatedTarget && e.relatedTarget.tagName === "A") {
      return;
    }

    // удалим класс: vg-search-reverse (поле поиска закроется)
    searchBtn.classList.remove("vg-search-reverse");
  });
}

// ~ Выпуск №99
// в переменную сохраним самовызывающуюся функцию, внутри которой будет реализовано замыкание (для работы с
// появляющимися подсказками при вводе строки в поле поиска) Вызывается сразу после кода
// (эта функция будет возвращать другую функцию, которую мы и будем вызывать по обращению к имени: searchResultHover)
let searchResultHover = (() => {
  // Инициализируем ряд переменных Эти переменные инициализируются один раз (при первом обращении к ф-ии в переменной:
  // searchResultHover) и затем будут замкнуты в участке кода до: return () => {} и фактически выполнятся только один раз
  // Каждый раз, когда мы будем повторно вызывать: searchResultHover(), будет вызывться функция которая вернулась т.е.
  // return() => { }, а переменные описанные выше неё останутся нетронутыми(т.е.замкнутыми) и будет выполняться (исходя
  // из нового вызова) участок кода описанный внутри: return () => { }:

  // найдём и сохраним элемент с классом внутри которого будет выпадающее меню с ссылками-подсказками для поиска
  let searchRes = document.querySelector(".search_res");

  // аналогично найдём input с type = text (также можно было бы работать и с name="search"), содержащийся в блоке
  // поиска (с id="searchButton")
  let searchInput = document.querySelector("#searchButton input[type=text]");

  // объявим переменную- дефолтное значение для Input поиска
  let defaultInputValue = null;

  /**
   * Метод, который будет обрабатывать нажатие стрелочек (вниз-вверх) в подсказках при поиске (Выпуск №100)
   * (на вход: e- объект события)
   */
  function searchKeyDown(e) {
    // если элемент с id = searchButton не содержит класса: vg-search-reverse (т.е. не активен) или не нажата кнопка:
    // стрелка-вверх и не нажата кнопка: стрелка-вниз (в объекте: е- событие, есть свойство: key, которое и показывает какую кнопку нажали)
    if (
      !document
        .querySelector("#searchButton")
        .classList.contains("vg-search-reverse") ||
      (e.key !== "ArrowUp" && e.key !== "ArrowDown")
    ) {
      // завершаем работу скрипта
      return;
    }

    // сделаем деструктивное присваивание (приведём к массиву) для содержимого в searchRes.children
    let children = [...searchRes.children];

    if (children.length) {
      // скинем действия по умолчанию (чтобы курсор не перескакивал на начало слова в строке поиска, при нажатии на кнопки: вверх (вниз))
      e.preventDefault();

      // получим активный элемент (выделенная ссылка в выпадающем меню подсказок при поиске)
      // если querySelector() ничего не найдёт, то по умолчанию вернёт: null
      let activeItem = searchRes.querySelector(".search_act");

      // сформируем переменную по условию и получим индекс элемента, который лежит в activeItem, иначе: -1
      let activeIndex = activeItem ? children.indexOf(activeItem) : -1;

      // если нажата кнопка: стрелка-вниз
      if (e.key === "ArrowUp") {
        // сформируем переменную по условию
        // здесь- (children.length - 1) означает последний элемент массива
        activeIndex = activeIndex <= 0 ? children.length - 1 : --activeIndex;

        // если не нажата
      } else {
        // сформируем переменную по другому условию
        activeIndex = activeIndex === children.length - 1 ? 0 : ++activeIndex;
      }

      // у всех элементов: children необходимо убрать класс: search_act (если он есть)
      children.forEach((item) => item.classList.remove("search_act"));

      // обратимся к массиву в переменной: children (его ячейке: [activeIndex])  и добавим класс: search_act
      children[activeIndex].classList.add("search_act");

      // +Выпуск №113
      // в элемент: searchInput (в его значение: value) занесём значение: innerText из children[activeIndex]
      searchInput.value = children[activeIndex].innerText.replace(
        /\s*\(.+?\)\s*$/,
        "",
      );
    }
  }

  /**
   * Метод установки значения по умолчанию: для input в переменной: searchInput (в строке поиска)
   */
  function setDefaultValue() {
    // в переменную: searchInput (в его переменную: value) положим значение переменной: defaultInputValue
    searchInput.value = defaultInputValue;
  }

  // Опишем 2-а слушателя событий:
  // (На вход: 1- событие, 2- функция, должна быть вызвана только тогда, когда на элементе сработает обработчик событий
  // (для этого передаём её в качестве параметра без круглых скобок))
  // Иначе (с круглыми скобками) ф-я была бы вызвана до обработчика событий

  // Событие: mouseleave срабатывает, когда курсор манипулятора (обычно мыши) перемещается за границы элемента
  searchRes.addEventListener("mouseleave", setDefaultValue);

  // Событие: keydown срабатывает, когда клавиша была нажата
  window.addEventListener("keydown", searchKeyDown);

  //=======> Вернется самовызывающая функция (будет вызываться в качестве результата при каждом обращении к
  // переменной: searchResultHover (к ф-и в ней))
  return () => {
    //setTimeout(() => {

    // в переменую положим значение(value) searchInput(его поля), т.е. то что было введено пользователем
    defaultInputValue = searchInput.value;

    // если подсказки(ссылки) существуют в переменной: searchRes (его св-ве: children, его св-ве: length)
    if (searchRes.children.length) {
      //  свойство children объекта возвращает живую коллекцию (HTMLCollection), которая постонно отслеживается
      // (т.к. ссылки здесь будут постоянно меняться) и которая содержит все дочерние элементы узла, на котором оно было вызвано

      // используем деструктивное присваивание (преобразуем значение из searchRes.children в массив указав слева три
      // точки) и сохраним в переменной: children
      // (Деструктивное присваивание - упрощает извлечение данных из массивов и объектов, при помощи более короткого синтаксиса)
      let children = [...searchRes.children];

      children.forEach((item) => {
        // на текущий элемент: item, вешаем обработчик события на событие: mouseover (наведение указателя мыши)
        item.addEventListener("mouseover", () => {
          // уберём у children класс который подсвечивает подсказки (ссылки)
          children.forEach((el) => el.classList.remove("search_act"));

          // для текущего элемента: item добавим класс
          item.classList.add("search_act");

          // то что лежит в св-ве innerText (для элемента: item) положим в элемент: searchInput, в его св-во: value
          // (т.е. в поле поиска попадёт название той ссылки, на которую попадёт указатель мыши)
          searchInput.value = item.innerText;
        });
      });
    }

    //}, 5000);
  };
})();

// самовызывающуюся функцию необходимо вызывать сразу после того как её код описан
searchResultHover();

// ~ Выпуск №105
search();

// Функция отработает при вводе не менее 2-х символов в поле ввода строки поиска
function search() {
  let searchInput = document.querySelector("input[name=search]");

  //console.log(searchInput)

  if (searchInput) {
    searchInput.oninput = () => {
      if (searchInput.value.length > 1) {
        Ajax({
          // объект
          data: {
            // поля объекта
            data: searchInput.value,
            table: document.querySelector('input[name="search_table"]').value,
            ajax: "search",
          },
        }).then((res) => {
          try {
            res = JSON.parse(res);

            let resBlock = document.querySelector(".search_res");

            let counter = res.length > 20 ? 20 : res.length;

            if (resBlock) {
              resBlock.innerHTML = "";

              for (let i = 0; i < counter; i++) {
                resBlock.insertAdjacentHTML(
                  "beforeend",
                  `<a href="${res[i]["alias"]}">${res[i]["name"]}</a>`,
                );
              }

              searchResultHover();
            }
          } catch (e) {
            alert("Ошибка в системе поиска");
          }
        });
      }
    };
  }
}

/* myLib start - набор повторяющихся элементов для повторного использования */
(function () {
  // создаём глобальную переменную (пустой объект)
  window.myLib = {};

  // допишем в него повторяющиеся элементы и функции:

  window.myLib.body = document.querySelector("body");

  window.myLib.closestAttr = function (item, attr) {
    var node = item;

    while (node) {
      var attrValue = node.getAttribute(attr);
      if (attrValue) {
        return attrValue;
      }

      node = node.parentElement;
    }

    return null;
  };

  /**
   * функция находит ближайший элемент у которого класс соответствует параметру переданному на вход 2-ым: className
   * @param {*} item
   * @param {*} className
   * @returns
   */
  window.myLib.closestItemByClass = function (item, className) {
    var node = item;

    while (node) {
      if (node.classList.contains(className)) {
        return node;
      }

      node = node.parentElement;
    }

    return null;
  };
})();
/* myLib end */

/* map start - подключение карты с реализацией её загрузки только когда доскроллили до секции: section-contacts */

// Для взамодействия с картой кликните по ней Чтобы карту отключить, кликните в другом месте экрана
const mapWrapperElement = document.querySelector(".map-wrapper");

if (mapWrapperElement) {
  document.addEventListener("click", (e) => {
    mapWrapperElement.classList.toggle(
      "is-active",
      e.target === mapWrapperElement,
    );
  });

  (function () {
    var sectionContacts = document.querySelector(".section-contacts");

    var ymapInit = function () {
      if (typeof ymaps === "undefined") {
        return;
      }

      ymaps.ready(function () {
        var ymap = document.querySelector(".contacts__map");
        var coordinates = ymap.getAttribute("data-coordinates");
        var address = ymap.getAttribute("data-address");

        var myMap = new ymaps.Map(
            "ymap",
            {
              center: coordinates.split(","),
              zoom: 18,
            },
            {
              searchControlProvider: "yandex#search",
            },
          ),
          myPlacemark = new ymaps.Placemark(
            myMap.getCenter(),
            {
              balloonContent: address,
            },
            {
              iconLayout: "default#image",
              iconImageHref: ForJS.imgMap,
              iconImageSize: [100, 37],
              iconImageOffset: [-20, -30]
            },
          );

        myMap.geoObjects.add(myPlacemark);
        myMap.behaviors.disable("scrollZoom");
      });
    };

    var ymapLoad = function () {
      var script = document.createElement("script");
      script.src = "https://api-maps.yandex.ru/2.1/?lang=RU";
      myLib.body.appendChild(script);
      script.addEventListener("load", ymapInit);
    };

    var checkYmapInit = function () {
      var sectionContactsTop = sectionContacts.getBoundingClientRect().top;
      var scrollTop = window.pageYOffset;
      var sectionContactsOffsetTop = scrollTop + sectionContactsTop;

      if (scrollTop + window.innerHeight > sectionContactsOffsetTop) {
        ymapLoad();
        window.removeEventListener("scroll", checkYmapInit);
      }
    };

    window.addEventListener("scroll", checkYmapInit);
    checkYmapInit();
  })();
}

/* map end */
