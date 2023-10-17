function ajax(method, url, callback) {
  $.ajax({
    type: method,
    url: url,
    dataType: 'json',
    beforeSend: function () {
      Swal.fire({
        title: 'Loading...',
        allowOutsideClick: false,
        showConfirmButton: false,
      })
    },
    success: function (response) {
      Swal.close()
      callback(response)
    },
  })
}
