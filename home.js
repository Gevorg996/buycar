document.addEventListener('DOMContentLoaded', function () {
    // Удаляем прослушиватель события прокрутки
    // window.addEventListener('scroll', reveal);

    // Вызываем функцию reveal с задержкой
    setTimeout(reveal, 500); // Измените задержку по необходимости
});

function reveal() {
    let reveals = document.querySelectorAll('.block');

    // Функция для отображения каждого блока с задержкой
    function revealBlock(index) {
        setTimeout(function() {
            let reveal = reveals[index];
            reveal.classList.add('animated');
            if (index % 2 === 0) {
                reveal.classList.add('left');
            } else {
                reveal.classList.add('right');
            }
        }, index * 300); // Измените задержку между блоками по необходимости
    }

    // Перебираем каждый блок и отображаем их с задержкой
    for (let i = 0; i < reveals.length; i++) {
        revealBlock(i);
    }
}
