let obj ={}; // array with modified elements

//минус 1 при нажатии на -
$(document).on('click','.voitingMin', function () {
    let $block =$(this).closest('div');//находим ближайшего родителя
    //console.log($block);
    let $prop = $(this).next(); //значение свойства
    $prop.html(parseInt($prop.html()) -1); //минус 1 при нажатии на -
    $prop.css({color:"red"});//меняем цвет при нажатии
    $block.one('mouseout', function(){ // при потери фокуса изменного свойтсва
        let id = $block.attr("id").match(/[0-9]+/g)[1]; // id  измененного элемента
        let propValue = $prop.html(); //значение свойства измененного элемента
        obj[id]=propValue; //write value in array
    });

});
// добавление 1 при нажатии на +
$(document).on('click', '.voitingPlus', function () {
    //console.log($(this).prev());
    let $block =$(this).closest('div');
    let $prop = $(this).prev();//значение свойства
    $prop.html(parseInt($(this).prev().html()) +1);
    $prop.css({color:"green"}) //меняем цыет при нажатии
    $block.one('mouseout', function(){ // при потери фокуса изменного свойтсва
        let id = $block.attr("id").match(/[0-9]+/g)[1]; // id  измененного элемента
        let propValue = $prop.html(); //значение свойства измененного элемента
        obj[id]=propValue;
    });
})



/*
request in php file for change data base
*/
function request (){
    url =  '/local/components/myComponents/taskAlt.list/php/updateProperty.php'  //  URL, file with code change data base
  //  if (url !== undefined  && obj.length !== 0) { // if correct url and  array not empty
        $.ajax({
            type: 'POST',
            url: url,
            data: obj, //"array with changed data",
        })
   // }
  };
$(window).on('beforeunload unload ',request); // beforeunload  unload вместе для корректной работы в всез браузерах
