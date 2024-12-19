function blockUI() {
    KTApp.blockPage({
        overlayColor: 'blue',
        opacity: 0.1,
        state: 'primary' // a bootstrap color
    });
}

function unBlockUI() {
    KTApp.unblockPage();
}

function confirmDestroy(url, id, reference, callback) {
    let lang = $("html").attr("lang");
    Swal.fire({
        title: lang == "en" ? "Are you sure?" : "هل أنت متأكد؟",
        text: lang == "en" ? "This item will be deleted!" : "سيتم حذف العنصر",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: lang == "en" ? "Yes, delete it!" : "تأكيد",
        cancelButtonText: lang == "en" ? "No, cancel!" : "إلغاء",
        reverseButtons: true,
    }).then(function (result) {
        if (result.value) {
            deleteItem(url, id, reference, callback);
            // result.dismiss can be "cancel", "overlay",
            // "close", and "timer"
        } else if (result.dismiss === "cancel") {
        }
    });
}

function deleteItem(url, id, reference, deleteCallback) {
    let lang = $("html").attr("lang");
    axios
        .delete("/" + lang + url + "/" + id)
        .then(function (response) {
            // handle success 2xx
            console.log(response);
            showMessage(response.data.message);
            if (deleteCallback != undefined) {
                deleteCallback(true);
            } else {
                reference.closest("tr").remove();
            }
        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            console.log(error);
            toastr.error(error.response.data.message);
            if (callback != undefined) {
                callback(true);
            }
        });
}

function showMessage(message, error = false) {
    Swal.fire({
        position: "center",
        icon: !error ? "success" : "error",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}

async function store(url, data, redirectRoute) {
   
    let lang = $("html").attr("lang");
    blockUI();
    await axios
        .post("/" + lang + url, data)
        .then(function (response) {
            unBlockUI();
            if (redirectRoute != undefined) {
                window.location.href = redirectRoute;
            } else {
                toastr.success(response.data.message);
                document.getElementById("create-form").reset();
            }

        })
        .catch(function (error) {
            unBlockUI();
            toastr.error(error.response.data.message);

        });

}

async function update(url, data, redirectRoute, updateCallback) {
    let lang = $("html").attr("lang");
    blockUI();

    let permform = await axios
        .put("/" + lang + url, data)
        .then(function (response) {
            // handle success 2xx
            if (redirectRoute != undefined) {
                window.location.href = redirectRoute;
            } else {
                toastr.success(response.data.message);
            }

            if (updateCallback != undefined) {
                callback(true);
            }
        unBlockUI();

        })
        .catch(function (error) {
            // handle error 4xx - 5xx
            toastr.error(error.response.data.message);
            unBlockUI();

        });

}

function showToaster(message, error = false) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };
    if (error) toastr.error(message);
    else toastr.success(message);
}

