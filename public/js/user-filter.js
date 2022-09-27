const formSelector = $('#AdminFilterForm, #UserFilterForm');
const sortSelector = $(`#sort`);
const pageSelector = $(`#page`);
const shownEl = $(`#shown`)[0];
const listSelector = $(`#user-list`);
const isAdminPage = formSelector[0].getAttribute('name') === 'AdminFilterForm';

let oldWhere = formSelector.serialize();
let count;
let maxPageCount;

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();

    oldWhere = formSelector.serialize();

    updateContent(true);
});

pageSelector[0].addEventListener('change', () =>
{
    updateContent();
});

sortSelector[0].addEventListener('change', () =>
{
    updateContent();
});

formSelector[0].dispatchEvent(new Event('submit'));

function getData(updatePage = false)
{
    let data = {
        where: oldWhere,
        page: pageSelector[0].value || 1,
        order: sortSelector[0].value || 'fullname',
        formName: formSelector[0].getAttribute('name'),
    };

    if (updatePage) {
        data.updatePage = true;
        data.page = 1;
    }

    return data;
}

function updateContent(updatePage = false)
{
    $.ajax({
        url: '/admin/list/get',
        method: 'post',
        dataType: 'json',
        data: getData(updatePage),
    }).done((data) =>
    {
        if ('pageCount' in data) {
            const pageCount = data['pageCount'];

            pageSelector[0].innerHTML = '<option value="1">1</option>';
            for (let i = 2; i <= pageCount; i++) {
                pageSelector[0].innerHTML += `<option value="${i}">${i}</option>`;
            }
        }

        if ('userList' in data) {
            const userList = data['userList'];

            listSelector[0].innerHTML = `<div class="notification">Список пуст.</div>`;

            for (const user of userList) {
                const isActive = user['isActive'];
                const isAdmin = user['isAdmin'];
                const imagePath = user['imagePath'];
                const fullname = user['fullname'];
                const positionName = user['positionName'];
                const ageString = user['ageString'];
                const genderString = user['genderString'];
                const userId = user['userId'];

                const adminSignHtml = `<svg xmlns="http://www.w3.org/2000/svg" 
                    width="24" height="24" fill="currentColor" class="bi bi-key-fill ms-1" viewBox="0 0 16 16">
                    <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 
                    1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path></svg>`;

                const imageHtml = `<div class="col-auto">
                        <img src="${imagePath}"
                             class="user-photo img-fluid rounded"
                             alt="Фото пользователя">
                    </div>`;

                const fullnameHtml = `<div class="col-12">
                        <p class="h6 full-name">
                            ${fullname}
                            ${isAdmin ? adminSignHtml : ''}
                        </p>
                    </div>`;

                const posHtml = `<div class="col-auto">
                        <span class="text-secondary">Должность:</span>
                        <span class="position">${positionName}</span>
                    </div>`;

                const ageHtml = `<div class="col-auto">
                        <span class="text-secondary">Возраст:</span>
                        <span class="age">${ageString}</span>
                    </div>`;

                const genderHtml = `<div class="col-auto">
                        <span class="text-secondary">Пол:</span>
                        <span class="gender">${genderString}</span>
                    </div>`;

                const editHtml = `<div class="col-auto d-flex align-items-center">
                        <a href="/admin/list/${userId}" class="btn btn-primary">Редактировать</a>
                    </div>`;

                listSelector[0].innerHTML += `<div class="col-12${!isActive ? ' card-gray-bg' : ''}">
                        <div class="card p-3">
                            <div class="row g-3">
                                ${imageHtml}
                                <div class="col">
                                    <div class="row">
                                        ${fullnameHtml}
                                        ${posHtml}
                                        ${ageHtml}
                                        ${genderHtml}
                                    </div>
                                </div>
                                ${isAdminPage ? editHtml : ''}
                            </div>
                        </div>
                    </div>`;
            }
        }
    });
}