$.ajax({
    type: "POST",
    url: "./database/list.php",
    cache: false,
    data: {
        'action': 'get_list',
    },
    success: function (res) {
        // var jsonData = JSON.parse(res);
        console.log(res);
    },
});
