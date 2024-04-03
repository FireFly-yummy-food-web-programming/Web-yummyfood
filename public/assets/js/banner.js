// document.querySelectorAll('.delete-banner').forEach(item => {
//     item.addEventListener('click', event => {
//         event.preventDefault();

//         const bannerId = item.getAttribute('data-id');6+

//         if (confirm('Are you sure you want to delete this banner?')) {
//             fetch(`/admin/delete-banner/${bannerId}`, {
//                 method: 'DELETE',
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': '{{ csrf_token() }}'
//                 },
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error('Network response was not ok');
//                 }
//                 window.location.reload();
//             })
//             .catch(error => {
//                 console.error('There was a problem with your fetch operation:', error);
//             });
//         }
//     });
// });

// @section('js')
// <script>
//     document.querySelectorAll('.soft-delete-banner').forEach(item => {
//     item.addEventListener('click', event => {
//         event.preventDefault();

//         const id = item.getAttribute('data-id');

//         $('#soft_delete_banner_modal').modal('show');

//         $('#softDeleteBannerForm').attr('action', `/admin/soft-delete-banner/${id}`);
//     });
// });


//     function handleRestore(id) {
//         $.ajax({
//             url: '/admin/restore-banner/' + id,
//             type: 'POST',
//             data: {
//                 _token: '{{ csrf_token() }}',
//             },
//             success: function(response) {
//                 console.log(response);
//             },
//             error: function(xhr) {
//                 console.error(xhr.responseText);
//             }
//         });
//     }

//     function handlePermanentDelete(id) {
//     $.ajax({
//         url: '/admin/permanent-delete-banner/' + id,
//         type: 'POST',
//         data: {
//             _token: '{{ csrf_token() }}',
//         },
//         success: function(response) {
//             console.log(response);
//         },
//         error: function(xhr) {
//             console.error(xhr.responseText);
//         }
//     });
// }

// </script>
// @endsection

    $(document).ready(function () {
        $('.btn-danger').click(function () {
            var bannerId = $(this).data('id');
            $.ajax({
                url: '/soft-delete-banner/' + bannerId,
                type: 'GET',
                success: function (response) {
                    // Reload page or move data to soft deleted section
                    location.reload(); // Reload page
                    // Or move data to soft deleted section
                    // var deletedBanner = $(this).parents('tr');
                    // $('#softDeletedBannersTable tbody').append(deletedBanner); 
                }
            });
        });
    });
