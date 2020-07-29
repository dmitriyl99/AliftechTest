jQuery(function () {
    let cupboardSelect = $('select[name=\'cupboard_id\']');
    let cellSelect = $('select[name=\'cell_id\']');
    let folderSelect = $('select[name=\'folder_id\']');
    if (cellSelect.length > 0) {
        cupboardSelect.on('change', function (event) {
            $.ajax({
                url: '/api/cupboards/' + this.value + '/cells',
                beforeSend: function (xhr) {
                    cupboardSelect.attr('disabled', 'disabled');
                    cellSelect.attr('disabled', 'disabled');
                },
                complete: function (xhr, status) {
                    if (status === 'success') {
                        let response = xhr.responseJSON;
                        cellSelect.empty();
                        cellSelect.append('<option selected disabled>-- Выберите ячейку --</option>');
                        response.forEach(function (item) {
                            let html = `<option value='${item.id}'>${item.title}</option>`;
                            cellSelect.append(html);
                        });
                        cellSelect.removeAttr('disabled');
                        cupboardSelect.removeAttr('disabled');
                    }
                }
            })
        });
        if (folderSelect.length > 0) {
            cellSelect.on('change', function () {
                $.ajax({
                    url: '/api/cells/' + this.value + '/folders',
                    beforeSend: function (xhr) {
                        cellSelect.attr('disabled', 'disabled');
                        folderSelect.attr('disabled', 'disabled');
                    },
                    complete: function (xhr, status) {
                        if (status === 'success') {
                            let response = xhr.responseJSON;
                            folderSelect.empty();
                            folderSelect.append('<option selected disabled>-- Выберите папку --</option>');
                            response.forEach(function (item) {
                                let html = `<option value="${item.id}">${item.title}</option>`;
                                folderSelect.append(html);
                            });
                            folderSelect.removeAttr('disabled');
                            cellSelect.removeAttr('disabled');
                        }
                    }
                })
            })
        }
    }
});
