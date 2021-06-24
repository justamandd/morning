var qtdelistas = 0;
/** help */
function log(message) {
    console.log('> ' + message)
}

//var lists = document.querySelectorAll('.list')
var cards = document.querySelectorAll('.card')
//const dropzonesL = document.querySelectorAll('.dz_list')
const dropzones = document.querySelectorAll('.dz_card')

//lembrar de atualizar o refresh
refresh();


function dragstart() {
    // log('CARD: Start dragging ')
    dropzones.forEach(dropzone => dropzone.classList.add('highlight'))

    // this = card
    this.classList.add('is-dragging')
}

function drag() {
    // log('CARD: Is dragging ')
}

function dragend() {
    // log('CARD: Stop drag! ')
    dropzones.forEach(dropzone => dropzone.classList.remove('highlight'))

    // this = card
    this.classList.remove('is-dragging')
}

function dragenter() {
    // log('DROPZONE: Enter in zone ')
}

function dragover() {
    // this = dropzone
    this.classList.add('over')

    // get dragging card
    const cardBeingDragged = document.querySelector('.is-dragging')

    // this = dropzone
    this.appendChild(cardBeingDragged)
}

function dragleave() {
    // log('DROPZONE: Leave ')
    // this = dropzone
    this.classList.remove('over')

}

function drop() {
    // log('DROPZONE: dropped ')
    this.classList.remove('over')
}

function refresh() {

    //var lists = document.querySelectorAll('.list')
    var cards = document.querySelectorAll('.card');
    var dropzones = document.querySelectorAll('.dz_card');

    /*
    lists.forEach(list => {
        list.addEventListener('dragstart', dragstart)
        list.addEventListener('drag', drag)
        list.addEventListener('dragend', dragend)
    });
    dropzonesL.forEach(dropzoneL => {
        dropzoneL.addEventListener('dragenter', dragenter)
        dropzoneL.addEventListener('dragover', dragover)
        dropzoneL.addEventListener('dragleave', dragleave)
        dropzoneL.addEventListener('drop', drop)
    })
    */
    cards.forEach(card => {
        card.addEventListener('dragstart', dragstart)
        card.addEventListener('drag', drag)
        card.addEventListener('dragend', dragend)
    })

    dropzones.forEach(dropzone => {
        dropzone.addEventListener('dragenter', dragenter)
        dropzone.addEventListener('dragover', dragover)
        dropzone.addEventListener('dragleave', dragleave)
        dropzone.addEventListener('drop', drop)
    })
}

function criarList() 
{
    var numList = qtdelistas;
    // const lists = document.createElement('div');
    // lists.classList.add('lists')

    //var titulo = document.createElement('input');

    //titulo.setAttribute('id','inputNameList'+numList);
    //titulo.setAttribute('id','inputNameList').value;
    //textH2.appendChild(titulo);

    //var titulo = document.getElementById('id','inputNameList'+numList);

    //var texto = document.getElementById("inputNameList").value;
    //var texto = document.querySelector("#inputNameList").value;
    //document.querySelector("#list_title").innerHTML = "<h2>"+texto+"</h2>";
    //var texto = document.getElementById("inputNameList").value;
    //var lista = document.getElementById("btn_lista");

    //lista.innerHTML +=`<h2 id="list_title"></h2>`;

    var lists = document.querySelectorAll('.lists');

    const divDzlist = document.createElement('div');
    divDzlist.classList.add('dz_list');
    divDzlist.setAttribute('id', 'dz_list' + numList);

    const btn_RemoveL = document.createElement('button');
    btn_RemoveL.setAttribute('onclick','ExcluirList('+ numList +')');
    btn_RemoveL.setAttribute('id','remove_list'+ numList);
    btn_RemoveL.classList.add('remove_list');
    btn_RemoveL.innerText = 'X';

    const divlist = document.createElement('div');
    divlist.classList.add('list');
    divlist.setAttribute('draggable','false');
    
    const textH2 = document.createElement('h2');
    textH2.setAttribute('id','list_title')
    //textH2.innerText = 'teste3';
    var h2titulo = document.getElementById('inputNameList').value;
    textH2.innerText = h2titulo;

    var inputNomedalista = document.getElementById('inputNameList');
    inputNomedalista.setAttribute('id','inputNameList');

    const divDzCard = document.createElement('div');
    divDzCard.classList.add('dz_card');
    divDzCard.setAttribute('id', 'dz_card' + numList);

    //
    const Ccard = document.createElement('div');
    Ccard.classList.add('card');
    Ccard.setAttribute('draggable','true');

    //
    const Ccontent = document.createElement('div');
    Ccontent.classList.add('content');
    Ccontent.setAttribute('id','card_title');
    
    const divInpCard = document.createElement('div');
    //divInpCard.setAttribute('id','list_title');
    //divInpCard.setAttribute('id','input_card_title1');
    divInpCard.classList.add('div_input_card');
    
    const inpCard = document.createElement('input');
    inpCard.setAttribute('id','input_card_title'+numList);
    inpCard.classList.add('input_card_title');
    inpCard.setAttribute('placeholder','titulo do cartão')
    
    const BtnCard = document.createElement('button');
    BtnCard.setAttribute('onclick','criarCard(' + numList +')');
    BtnCard.setAttribute('id','btn_card');
    BtnCard.innerHTML = '+';



/*************************************************************** */
    const divInpList = document.createElement('div');
    divInpList.classList.add('inputList');
    
    const iptList = document.createElement('input');
    iptList.setAttribute('id','inputNameList');
    iptList.setAttribute('placeholder','titulo da lista');
/*************************************************************** */


    //recebe o valor do input
    //cria titulo
    //textH2.innerHTML = `<h4 id="list_title">${h2titulo}</h4>`;

    const BtnList = document.createElement('button');
    BtnList.setAttribute('onclick','criarList(' + numList +')');
    BtnList.setAttribute('id','btn_lista');
    BtnList.innerHTML = '+';

    var BtnListRemove = document.getElementById('btn_lista');

    divDzlist.appendChild(divlist);
    divlist.appendChild(textH2);
    divlist.appendChild(divDzCard);
    //divlist.appendChild(btn_RemoveL);
    textH2.appendChild(btn_RemoveL);
    //divDzCard.appendChild(Ccard);
    //divDzCard.appendChild(Ccontent);
    //Ccard.appendChild(btn_Remove);
    divlist.appendChild(divInpCard);
    divInpCard.appendChild(inpCard);
    divInpCard.appendChild(BtnCard);
    //divDzlist.appendChild(BtnList);

    inputNomedalista.remove();
    BtnListRemove.remove();

    //inputNomedalista.setAttribute.add('inputNameList','input');

    //document.querySelectorAll('.lists').appendChild(divDzlist);

    lists[0].appendChild(divDzlist);


    /******************************************************** */
    divInpList.appendChild(iptList);
    divInpList.appendChild(BtnList);
    lists[0].appendChild(divInpList);
    /******************************************************** */
    //inpCard = value='';
    //lists[0].appendChild(Ccard);
    
    var cards = document.querySelectorAll('.card');

    refresh();
    qtdelistas++;

}

function ExcluirCard(num){
    var List2 = document.getElementById('dz_card'+num);
    //var List2 = document.getElementsByClassName('lists')[0];
    var Cardd = List2.getElementsByClassName('card');

// Removendo determinado elemento
    List2.removeChild(Cardd[0]);
    
}

function ExcluirList(num){
    var List2 = document.getElementById('dz_list'+num);
// Removendo determinado elemento
    List2.remove();
    qtdelistas--;
    
}

function criarCard(numList) {
    //cria uma div
    const divCard = document.createElement('div');

   const btn_Remove = document.createElement('button');
    btn_Remove.setAttribute('onclick','ExcluirCard('+ numList +')');
    btn_Remove.setAttribute('id','remove_card'+ numList);
    btn_Remove.classList.add('remove_card');
    btn_Remove.innerText = 'x';
    //cria uma div
    const divContent = document.createElement('div');
    //recebe o valor do input
    var content = document.getElementById('input_card_title' + numList).value;

    divCard.classList.add('card');
    divCard.setAttribute('draggable', 'true');
    divContent.classList.add('content');
    divContent.innerText = content;

    //divCard.appendChild(btn_Remove);
    divCard.appendChild(divContent);
    divContent.appendChild(btn_Remove);

    const dropzones = document.querySelectorAll('.dz_card');
    
    dropzones[numList].appendChild(divCard);
    
    refresh();
}
// gerar automáticamente a página

function generate() {
    const dz_list = document.createElement('div');
    dz_list.classList.add('dropzoneList');

    const list = document.createElement('div');
    list.classList.add('list');

    dz_list.appendChild(list);

    const list_title = document.createElement('h3');
    list_title.setAttribute('id', 'list_title');

    list.appendChild(list_title);

    const dz_card = document.createElement('div');
    dz_card.classList.add('dropzoneCard');

    list.appendChild(dz_card);

    const card = document.createElement('div');
    card.classList.add('card');
    card.setAttribute('draggable', 'true');

    dz_card.appendChild(card);

    const card_title = document.createElement('div');
    card_title.classList.add('content');
    card_title.setAttribute('id', 'card_title');

    card.appendChild(card_title)

    const div_input_card = document.createElement('div');
    div_input_card.classList.add('div_input_card');

    list.appendChild(div_input_card);

    const input_card = document.createElement('input');
    input_card.setAttribute('id', 'input_card_title');

    div_input_card.appendChild(input_card);

    const btnCard = document.createElement('button');
    btnCard.setAttribute('onclick', 'criarCard()');
    btnCard.setAttribute('id', 'btn_card')
    btnCard.innerText = '+';

    div_input_card.appendChild(btnCard);

    const lists = document.querySelectorAll('.lists');

    lists.appendChild(dz_list);
}