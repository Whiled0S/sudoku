window.onload = function () {
    const table = document.querySelector('table');
    const taskId = table.getAttribute('task-id');
    const submit = document.querySelector('button');
    const allCells = Array.from(document.querySelectorAll('td'));
    const activeCells = allCells.filter(cell => cell.classList.contains('active'));


    table.onclick = function (event) {
        if (!activeCells.includes(event.target)) return;

        const cell = event.target;

        if (!cell.innerText.length || cell.innerText === '9')
            cell.innerText = '1';
        else
            cell.innerText = (parseInt(cell.innerText) + 1).toString();
    };

    submit.onclick = async function () {
        const data = new FormData();
        const numsArray = allCells.reduce((acc, cell) => {
            return cell.innerText === '' ? [...acc, '0'] : [...acc, cell.innerText];
        }, []);

        data.append('solution', numsArray);
        data.append('task_id', taskId);

        const response = await fetch('http://localhost/sudoku/handler.php', {
            method: 'POST',
            body: data
        }).then(res => res.json());

        if (response.success)
            alert('Вы выиграли!');
        else
            alert('Кажется, вы где-то допустили ошибку');
    }
};

getNumsArr = function() {
    const tds = Array.from(document.querySelectorAll('td'));
    const cells = tds.filter(td => td.children.length === 2);
    const arr = cells.reduce((acc, curr) => {
        const textNode = curr.querySelector('div');

        return !textNode.innerText.length ?
            [...acc, 0] : [...acc, parseInt(textNode.innerText)];
    }, []);

    let arr1 = [];

    for (let i = 0; i < 9; i++) {
        const begin = i * 9;
        let buffer = [];

        for (let j = 0; j < 9; j++) {
            buffer.push(arr[begin + j]);
        }

        arr1.push(buffer);
    }

    let arr2 = [];

    for (let k = 0; k < 3; k++) {
        const begin = k * 3;
        for (let i = 0; i < 3; i++) {
            for (let j = begin; j < begin + 3; j++) {
                const begin = i * 3;
                for (let e = begin; e < begin + 3; e++) {
                    arr2.push(arr1[j][e]);
                }
            }
        }
    }

    return arr2.join(',');
};