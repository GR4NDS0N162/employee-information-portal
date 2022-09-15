const formSelector = $('#AdminFilterForm');
const sort = $(`#sort`);
const page = $(`#page`);

function getData()
{
    return {
        where: formSelector.serialize(),
        page: page[0].value || 1,
        order: sort[0].value || 'fullname',
    };
}

formSelector[0].addEventListener('submit', (e) =>
{
    e.preventDefault();
    page.value = 1;
    updateContent('where');
});

sort.addEventListener('change', () =>
{
    updateContent('order');
});

page.addEventListener('change', () =>
{
    updateContent('page');
});

let oldForm = formSelector.serializeArray();

updateContent();

function byName(element, elName)
{
    return element.find(({name}) => name === elName);
}

function updateContent(type = 'all')
{
    let newForm = formSelector.serializeArray();

    if (type === 'page' || type === 'all') {
        byName(oldForm, 'page').value = byName(newForm, 'page').value;
    } else if (type === 'order' || type === 'all') {
        byName(oldForm, 'sort').value = byName(newForm, 'sort').value;
    } else if (type === 'where' || type === 'all') {
        byName(oldForm, 'positionId').value = byName(newForm, 'positionId').value;
        byName(oldForm, 'gender').value = byName(newForm, 'gender').value;
        byName(oldForm, 'age[min]').value = byName(newForm, 'age[min]').value;
        byName(oldForm, 'age[max]').value = byName(newForm, 'age[max]').value;
        byName(oldForm, 'fullnamePhoneEmail').value = byName(newForm, 'fullnamePhoneEmail').value;
        byName(oldForm, 'active').value = byName(newForm, 'active').value;
        byName(oldForm, 'admin').value = byName(newForm, 'admin').value;
    }

    $.ajax({
        url: '/admin/list/get',
        method: 'post',
        dataType: 'html',
        data: {
            form: oldForm,
        },
    }).done((data) =>
    {
        $(`#user-list`).html(data);
    });

    oldForm = newForm;
}
