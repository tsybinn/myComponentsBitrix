
// let parent = document.querySelectorAll('.parent'); // находим все элемнты с классом parent
// for(var i = 0;i<parent.length;i++){
//     parent[i].addEventListener('click', func);  // вешаем событие по клику на каждый элемент
// }
// function func() {
//     this.nextElementSibling.classList.toggle("active"); //добавляем или удаляем класс следующему элементу
// }


//jquery
 var elem = $('.parent').on('click', function() {
    this.nextElementSibling.classList.toggle("active");
});
