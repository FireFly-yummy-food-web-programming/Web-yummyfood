function handleDelete(id) {
var form = document.getElementById('deleteCategoryForm');
form.action = '/admin/delete-category/' + id;
$('#delete_category_modal').modal('show');
// console.log(form.action);
}

function handleRestore(id) {
var form = document.getElementById('restoreCategoryForm');
form.action = '/admin/restore-category/' + id;
$('#restore_category_modal').modal('show');
}
function handleDeleteDish(id) {
    var form = document.getElementById('deleteDishForm');
    form.action = '/admin/delete-dish/' + id;
    $('#delete_dish_modal').modal('show');
    console.log(form.action);
    }
    
function handleRestoreDish(id) {
var form = document.getElementById('');
form.action = '/admin/restore-dish/' + id;
$('#restore_dish_modal').modal('show');
}