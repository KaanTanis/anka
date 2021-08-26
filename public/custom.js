function imgDestroyBtn(url, id = null) {
    Swal.fire({
        title: areYouSure,
        text: youDeletingImage,
        icon: 'question',
        confirmButtonText: yesDelete,
        cancelButtonText: cancel,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post(url).then(function (res) {
                Swal.fire({
                    title: res.data.message,
                    icon: res.data.status,
                    confirmButtonText: okay
                })
                if(res.data.status === 'success') {
                    if ($('#image_id_' + id).length) {
                        $($('#image_id_' + id)).fadeOut(600, function () {
                            $(this).remove();
                        })
                    }
                }
                if (res.data.redirect.length) {
                    window.location = res.data.redirect
                }

            })
        }
    })
}


function destroyPage(url) {
    Swal.fire({
        title: areYouSure,
        text: pageDestroying,
        icon: 'question',
        confirmButtonText: yesDelete,
        cancelButtonText: cancel,
        showCancelButton: true
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(url).then(function (res) {
                if (res.data.message) {
                    Swal.fire({
                        title: res.data.message,
                        icon: res.data.status,
                        confirmButtonText: okay
                    })
                }

                if(res.data.redirect) {
                    setTimeout(function () {
                        window.location = res.data.redirect
                    }, 500)
                }
            })
        }
    })
}
