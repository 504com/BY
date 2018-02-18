/*!
 * Tabledit v1.2.3 (https://github.com/markcell/jQuery-Tabledit)
 * Copyright (c) 2015 Celso Marques
 * Licensed under MIT (https://github.com/markcell/jQuery-Tabledit/blob/master/LICENSE)
 */

/**
 * @description Inline editor for HTML tables compatible with Bootstrap
 * @version 1.2.3
 * @author Celso Marques
 */



if (typeof jQuery === 'undefined') {
  throw new Error('Tabledit requires jQuery library.');
}

(function($) {
    'use strict';

    // configure input calendar datepicker
    var optionsDatePicker = {
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'Aujourd\'hui',
        clear: 'Effacer',
        min: true,
        formatSubmit: 'yyyy-mm-dd',
        format: 'dd/mm/yyyy',
        firstDay: 1,
        onClose: function() {
            var day = this.get('select').day;

            if (day == 0) {
                day = 7;
            }
            var id = $('input[name="id"]').val();
            var url = laroute.route('workhours.index', {id: id, day: day});
            var date = this.get('select').obj;
            $.get(url, {
                date: date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate()
            }, function (data) {
                $('select[name="time"]').html(data);
            });
            $(document.activeElement).blur();
        }
    };

    $.fn.Tabledit = function(options) {
        if (!this.is('table')) {
            throw new Error('Tabledit only works when applied to a table.');
        }

        var $table = this;

        var defaults = {
            url: window.location.href,
            inputClass: 'form-control input-sm',
            toolbarClass: 'btn-toolbar',
            groupClass: 'btn-group btn-group-sm',
            dangerClass: 'danger',
            warningClass: 'warning',
            mutedClass: 'text-muted',
            eventType: 'click',
            rowIdentifier: 'id',
            hideIdentifier: false,
            autoFocus: true,
            editButton: true,
            deleteButton: true,
            saveButton: true,
            restoreButton: false,
            buttons: {
                edit: {
                    class: 'btn btn-sm btn-default',
                    html: '<span class="glyphicon glyphicon-pencil"></span>',
                    action: 'edit'
                },
                delete: {
                    class: 'btn btn-sm btn-default',
                    html: '<span class="glyphicon glyphicon-trash"></span>',
                    action: 'delete'
                },
                save: {
                    class: 'btn btn-sm btn-success',
                    html: 'Enregistrer'
                },
                restore: {
                    class: 'btn btn-sm btn-warning',
                    html: 'Restore',
                    action: 'restore'
                },
                confirm: {
                    class: 'btn btn-sm btn-danger',
                    html: 'Confirmer'
                },
                create: {
                    action: 'create'
                }
            },
            onDraw: function() {
                return; },
            onSuccess: function(data) {
                var msg = data['error'];
                if(msg != 'undefined'){
                    var blocMsg = '<div class="col-xs-10 col-md-6 col-lg-4">' +
                        '<div class="alert alert-warning fade in" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span>' +
                        '</button>'
                        + msg +
                        '</div>' +
                        '</div>';
                    $('#inlineAjaxMsg').html(blocMsg);
                    return;
                }
                msg = data['message'];
                blocMsg = '<div class="col-xs-10 col-md-6 col-lg-4">' +
                    '<div class="alert alert-success fade in" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>'
                     + msg +
                    '</div>' +
                    '</div>';
                $('#inlineAjaxMsg').html(blocMsg);
                return;
                },
            onFail: function(data) {
                /*var blocMsg = '<div class="col-xs-10 col-md-6 col-lg-4">' +
                    '<div class="alert alert-warning fade in" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                    '<span aria-hidden="true">&times;</span>' +
                    '</button>'
                    + 'Erreur technique' +
                    '</div>' +
                    '</div>';
                $('#inlineAjaxMsg').html(blocMsg);*/
                return; },
            onAlways: function() { return; },
            onAjax: function() { return; }
        };

        var settings = $.extend(true, defaults, options);

        var $lastEditedRow = 'undefined';
        var $lastDeletedRow = 'undefined';
        var $lastRestoredRow = 'undefined';
        var $currentEditingRow = 'undefinded';

        /**
         * Draw Tabledit structure (identifier column, editable columns, toolbar column).
         *
         * @type {object}
         */
        var Draw = {
            columns: {
                identifier: function() {
                    // Hide identifier column.
                    if (settings.hideIdentifier) {
                        $table.find('th:nth-child(' + parseInt(settings.columns.identifier[0]) + 1 + '), tbody td:nth-child(' + parseInt(settings.columns.identifier[0]) + 1 + ')').hide();
                    }

                    var $td = $table.find('tbody td:nth-child(' + (parseInt(settings.columns.identifier[0]) + 1) + ')');

                    $td.each(function() {
                        // Create hidden input with row identifier.
                        var span = '<span class="tabledit-span tabledit-identifier">' + $(this).text() + '</span>';
                        var input = '<input class="tabledit-input tabledit-identifier" type="hidden" name="' + settings.columns.identifier[1] + '" value="' + $(this).text() + '" disabled>';

                        // Add elements to table cell.
                        $(this).html(span + input);

                        // Add attribute "id" to table row.
                        $(this).parent('tr').attr(settings.rowIdentifier, $(this).text());
                    });
                },
                editable: function() {
                    for (var i = 0; i < settings.columns.editable.length; i++) {
                        var $td = $table.find('tbody td:nth-child(' + (parseInt(settings.columns.editable[i][0]) + 1) + ')');
                        $td.each(function() {
                                // Get text of this cell.
                                var text = $(this).text();
                                // Add pointer as cursor.
                                if (!settings.editButton) {
                                    $(this).css('cursor', 'pointer');
                                }
                                // Create span element.
                                var span = '<span class="tabledit-span">' + text + '</span>';
                                // Create text input element.
                                var input = '<input class="tabledit-input ' + settings.inputClass + '" type="text" name="' + settings.columns.editable[i][1] + '" value="' + $(this).text() + '" style="display: none;" disabled>';

                            // Check if exists the third parameter of editable array.
                            if (typeof settings.columns.editable[i][2] !== 'undefined') {
                                // Create select element.
                                var input = '<select class="tabledit-input ' + settings.inputClass + '" name="' + settings.columns.editable[i][1] + '" style="display: none;" disabled>';

                                // Create options for select element.
                                $.each(jQuery.parseJSON(settings.columns.editable[i][2]), function(index, value) {
                                    if (text === value) {
                                        input += '<option value="' + index + '" selected>' + value + '</option>';
                                    } else {
                                        input += '<option value="' + index + '">' + value + '</option>';
                                    }
                                });

                                // Create last piece of select element.
                                input += '</select>';
                            }
                            // Add elements and class "view" to table cell.
                            $(this).html(span + input);
                            $(this).addClass('tabledit-view-mode');

                       });
                    }
                },
                toolbar: function() {
                    if (settings.editButton || settings.deleteButton) {
                        var editButton = '';
                        var deleteButton = '';
                        var saveButton = '';
                        var restoreButton = '';
                        var confirmButton = '';

                        // Add toolbar column header if not exists.
                        if ($table.find('th.tabledit-toolbar-column').length === 0) {
                        }

                        // Create edit button.
                        if (settings.editButton) {
                            editButton = '<button type="button" class="tabledit-edit-button ' + settings.buttons.edit.class + '" style="float: none;">' + settings.buttons.edit.html + '</button>';
                        }

                        // Create delete button.
                        if (settings.deleteButton) {
                            deleteButton = '<button type="button" class="tabledit-delete-button ' + settings.buttons.delete.class + '" style="float: none;">' + settings.buttons.delete.html + '</button>';
                            confirmButton = '<button type="button" class="tabledit-confirm-button ' + settings.buttons.confirm.class + '" style="display: none; float: none;">' + settings.buttons.confirm.html + '</button>';
                        }

                        // Create save button.
                        if (settings.editButton && settings.saveButton) {
                            saveButton = '<button type="button" class="tabledit-save-button ' + settings.buttons.save.class + '" style="display: none; float: none;">' + settings.buttons.save.html + '</button>';
                        }

                        // Create restore button.
                        if (settings.deleteButton && settings.restoreButton) {
                            restoreButton = '<button type="button" class="tabledit-restore-button ' + settings.buttons.restore.class + '" style="display: none; float: none;">' + settings.buttons.restore.html + '</button>';
                        }

                        var toolbar = '<div class="tabledit-toolbar ' + settings.toolbarClass + '" style="text-align: left;">\n\
                                           <div class="' + settings.groupClass + '" style="float: none;">' + editButton + deleteButton + '</div>\n\
                                           ' + saveButton + '\n\
                                           ' + confirmButton + '\n\
                                           ' + restoreButton + '\n\
                                       </div></div>';

                        // Add toolbar column cells.
                        $table.find('tr:gt(0)').append('<td style="white-space: nowrap; width: 1%;">' + toolbar + '</td>');
                    }
                }
            }
        };

        /**
         * Change to view mode or edit mode with table td element as parameter.
         *
         * @type object
         */
        var Mode = {
            view: function(td) {
                // Get table row.
                var $tr = $(td).parent('tr');
                // Disable identifier.
                $(td).parent('tr').find('.tabledit-input.tabledit-identifier').prop('disabled', true);
                // Hide and disable input element.
                $(td).find('.tabledit-input').blur().hide().prop('disabled', true);
                // Show span element.
                $(td).find('.tabledit-span').show();
                // Add "view" class and remove "edit" class in td element.
                $(td).addClass('tabledit-view-mode').removeClass('tabledit-edit-mode');
                // Update toolbar buttons.
                if (settings.editButton) {
                    $tr.find('button.tabledit-save-button').hide();
                    $tr.find('button.tabledit-edit-button').removeClass('active').blur();
                }
                // Hide selectTime element
                if( $(td).attr("name") === 'timeColumn'){
                    $(td).find('select[name="time"]').remove();
                    $(td).find('.tabledit-span').show();
                }
                // Hide dateColumn element
                if( $(td).attr("name") === 'dateColumn'){
                    // Update hide/show property
                    $(td).find('input[name="date"]').remove();
                    $(td).find('.tabledit-span').show();
                }
                // Remove select guests element
                if( $(td).attr("name") === 'guestsColmun'){
                    $(td).find('select[name="guests"]').removeClass('guestsSelectTarget');
                    $(td).find('select[name="guests"]').hide();
                }
            },
            edit: function(td) {
                Delete.reset(td);
                // Get table row.
                var $tr = $(td).parent('tr');
                // Enable identifier.
                $tr.find('.tabledit-input.tabledit-identifier').prop('disabled', false);
                // Hide span element.
                $(td).find('.tabledit-span').hide();
                // Get input element.
                var $input = $(td).find('.tabledit-input');
                // Enable and show input element.
                $input.prop('disabled', false).show();
                // Focus on input element.
                if (settings.autoFocus) {
                    $input.focus();
                }
                // create selectTime element and add it to specific column
                if( $(td).attr("name") === 'timeColumn'){
                    var text = $(td).find('.tabledit-span').text();
                    var span = '<span class="tabledit-span">' + text + '</span>';
                    var selectTimeElt = '<select class="form-control"  name="time" id="time" ><option >Choissiez le jour</option></select>';
                    $(td).html(span +  selectTimeElt);

                    //manage Hide/Show property
                    $(td).find('.tabledit-span').hide();
                    $(td).find('select[name="time"]').show();
                }
                if( $(td).attr("name") === 'dateColumn'){
                    // Create span/input calendar popup element
                    var text = $(td).find('.tabledit-span').text();
                    var span = '<span class="tabledit-span">' + text + '</span>';
                    var input =  '<input data-value="'+text+'" class="form-control target-date"  type="text" name="date" id="date"  style="display: none;" disabled>';
                    $(td).html(span + input);
                    $('input[name="date"]').pickadate(optionsDatePicker);

                    // Manage Hide/show property
                    $(td).find('input[name="date"]').prop('disabled', false).show();
                    $(td).find('.tabledit-span').hide();

                }
                if( $(td).attr("name") === 'guestsColmun'){
                    $(td).find('select[name="guests"]').addClass('guestsSelectTarget');
                }
                // Add "edit" class and remove "view" class in td element.
                $(td).addClass('tabledit-edit-mode').removeClass('tabledit-view-mode');
                // Update toolbar buttons.kjo
                if (settings.editButton) {
                    $tr.find('button.tabledit-edit-button').addClass('active');
                    $tr.find('button.tabledit-save-button').show();
                }
            }
        };

        /**
         * Available actions for edit function, with table td element as parameter or set of td elements.
         *
         * @type object
         */
        var Edit = {
            reset: function(td) {
                $(td).each(function() {
                    // Get input element.
                    var $input = $(this).find('.tabledit-input');
                    // Get span text.
                    var text = $(this).find('.tabledit-span').text();
                    // Set input/select value with span text.
                    if ($input.is('select')) {
                        $input.find('option').filter(function () {
                            return $.trim($(this).text()) === text;
                        }).attr('selected', true);
                    } else {
                        $input.val(text);
                    }
                    // Change to view mode.
                    Mode.view(this);
                });

                // reset date/time value
                var $dateColumn = $table.find('td[name="dateColumn"]');
                $dateColumn.find('input[name="date"]').remove();
                $dateColumn.find('.tabledit-span').show();

                var $timeColumn = $table.find('td[name="timeColumn"]');
                $timeColumn.find('select[name="time"]').remove();
                $timeColumn.find('.tabledit-span').show();

            },
            submit: function(td) {
                // Send AJAX request to server.
                var ajaxResult = ajax(settings.buttons.edit.action);
                if (ajaxResult === false) {
                    return;
                }

                $(td).each(function() {
                    // Get input element.
                    var $input = $(this).find('.tabledit-input');
                    // Set span text with input/select new value.
                    if ($input.is('select')) {
                        $(this).find('.tabledit-span').text($input.find('option:selected').text());
                    }
                    if( $(this).attr("name") === 'dateColumn'){
                        var input = $(this).find('input[name="date"]');
                        $(this).find('.tabledit-span').text(input.val());

                    }
                    if( $(this).attr("name") === 'timeColumn'){
                        var text = $(this).find('option:selected').text();
                        $(this).find('.tabledit-span').text(text);
                    }

                    // Change to view mode.
                    Mode.view(this);
                });

                // reset date/time value
                var $dateColumn = $table.find('td[name="dateColumn"]');
                $dateColumn.find('input[name="date"]').remove();
                $dateColumn.find('.tabledit-span').show();

                var $timeColumn = $table.find('td[name="timeColumn"]');
                $timeColumn.find('select[name="time"]').remove();
                $timeColumn.find('.tabledit-span').show();

                // Set last edited column and row.
                $lastEditedRow = $(td).parent('tr');
            }
        };

        /**
         * Available actions for delete function, with button as parameter.
         *
         * @type object
         */
        var Delete = {
            reset: function(td) {
                // Reset delete button to initial status.
                $table.find('.tabledit-confirm-button').hide();
                // Remove "active" class in delete button.
                $table.find('.tabledit-delete-button').removeClass('active').blur();
            },
            submit: function(td) {
                Delete.reset(td);
                // Enable identifier hidden input.
                $(td).parent('tr').find('input.tabledit-identifier').attr('disabled', false);
                // Send AJAX request to server.
                var ajaxResult = ajax(settings.buttons.delete.action);
                // Disable identifier hidden input.
                $(td).parents('tr').find('input.tabledit-identifier').attr('disabled', true);

                if (ajaxResult === false) {
                    return;
                }

                // Add class "deleted" to row.
                $(td).parent('tr').addClass('tabledit-deleted-row');
                // Hide table row.
                $(td).parent('tr').remove();
                // Set last deleted row.
                $lastDeletedRow = $(td).parent('tr');
            },
            confirm: function(td) {
                // Reset all cells in edit mode.
                $table.find('td.tabledit-edit-mode').each(function() {
                    Edit.reset(this);
                });
                // Add "active" class in delete button.
                $(td).find('.tabledit-delete-button').addClass('active');
                // Show confirm button.
                $(td).find('.tabledit-confirm-button').show();
            },
            restore: function(td) {
                // Enable identifier hidden input.
                $(td).parent('tr').find('input.tabledit-identifier').attr('disabled', false);
                // Send AJAX request to server.
                var ajaxResult = ajax(settings.buttons.restore.action);
                // Disable identifier hidden input.
                $(td).parents('tr').find('input.tabledit-identifier').attr('disabled', true);

                if (ajaxResult === false) {
                    return;
                }

                // Remove class "deleted" to row.
                $(td).parent('tr').removeClass('tabledit-deleted-row');
                // Hide table row.
                $(td).parent('tr').removeClass(settings.mutedClass).find('.tabledit-toolbar button').attr('disabled', false);
                // Hide restore button.
                $(td).find('.tabledit-restore-button').hide();
                // Set last restored row.
                $lastRestoredRow = $(td).parent('tr');
            }
        };

        /**
         * Parse ajax parametres into array[key, value]
         * */
        var parseQueryString = function( queryString ) {
            var params = {}, queries, temp, i, l;

            // Split into key/value pairs
            queries = queryString.split("&");

            // Convert the array of strings into an object
            for ( i = 0, l = queries.length; i < l; i++ ) {
                temp = queries[i].split('=');
                params[temp[0]] = temp[1];
            }

            return params;
        };

        /**
         * Send AJAX request to server.
         *
         * @param {string} action
         */
        function ajax(action)
        {
            var time = $('select[name="time"]').val();
            if(time === 'Choissiez le jour'){
                document.getElementById("errorDate").innerHTML = "Séléctionner votre date";
                return false;
            }
            var restaurantId = $('input[name="id"]').val();
            var name = $('input[name="name"]').val();
            var phone = $('input[name="phone"]').val();
            var guests = $table.find('.guestsSelectTarget').find('option:selected').text();
            var date_submit = $('input[name="date_submit"]').val();
            var serialize = $table.find('.tabledit-input').serialize();
            var arrayParams = parseQueryString(serialize);
            var bookingId = arrayParams['bookingId'];
            var act = action;
            switch(act) {
                case "edit":
                    settings.url = '/bookings/edit/1';
                    break;
                case "delete":
                    settings.url = '/bookings/destroy/1';
                    break;
                case "create":
                    guests =  $('select[name="guests"]').val();
                    settings.url = '/bookings/store';
                    break;
                default:
            }
            var result = settings.onAjax(action);

            if (result === false) {
                return false;
            }

            var jqXHR = $.get(settings.url, {
                    name: name,
                    phone: phone,
                    guests: guests,
                    time: time,
                    restaurantId: restaurantId,
                    bookingId: bookingId,
                    date_submit: date_submit
                }
                , function(data, textStatus, jqXHR) {

                if (action === settings.buttons.edit.action) {
                    $lastEditedRow.removeClass(settings.dangerClass).addClass(settings.warningClass);
                    setTimeout(function() {
                        //$lastEditedRow.removeClass(settings.warningClass);
                        $table.find('tr.' + settings.warningClass).removeClass(settings.warningClass);
                    }, 1400);
                }
                settings.onSuccess(data, textStatus, jqXHR);
            }, 'json');

            jqXHR.fail(function(jqXHR, textStatus, errorThrown) {
                if (action === settings.buttons.delete.action) {
                    $lastDeletedRow.removeClass(settings.mutedClass).addClass(settings.dangerClass);
                    $lastDeletedRow.find('.tabledit-toolbar button').attr('disabled', false);
                    $lastDeletedRow.find('.tabledit-toolbar .tabledit-restore-button').hide();
                } else if (action === settings.buttons.edit.action) {
                    $lastEditedRow.addClass(settings.dangerClass);
                }

                settings.onFail(jqXHR, textStatus, errorThrown);
            });

            jqXHR.always(function() {
                settings.onAlways();
            });

            return jqXHR;
        }

        Draw.columns.identifier();
        Draw.columns.editable();
        Draw.columns.toolbar();

        settings.onDraw();

        if (settings.deleteButton) {
            /**
             * Delete one row.
             *
             * @param {object} event
             */
            $table.on('click', 'button.tabledit-delete-button', function(event) {
                if (event.handled !== true) {
                    event.preventDefault();

                    // Get current state before reset to view mode.
                    var activated = $(this).hasClass('active');

                    var $td = $(this).parents('td');

                    Delete.reset($td);

                    if (!activated) {
                        Delete.confirm($td);
                    }

                    event.handled = true;
                }
            });

            /**
             * Delete one row (confirm).
             *
             * @param {object} event
             */
            $table.on('click', 'button.tabledit-confirm-button', function(event) {
                if (event.handled !== true) {
                    event.preventDefault();

                    var $td = $(this).parents('td');

                    Delete.submit($td);

                    event.handled = true;
                }
            });
        }

        if (settings.restoreButton) {
            /**
             * Restore one row.
             *
             * @param {object} event
             */
            $table.on('click', 'button.tabledit-restore-button', function(event) {
                if (event.handled !== true) {
                    event.preventDefault();

                    Delete.restore($(this).parents('td'));

                    event.handled = true;
                }
            });
        }

        if (settings.editButton) {
            /**
             * Activate edit mode on all columns.
             *
             * @param {object} event
             */
            $table.on('click', 'button.tabledit-edit-button', function(event) {
                if (event.handled !== true) {
                    event.preventDefault();

                    var $button = $(this);

                    // Get current state before reset to view mode.
                    var activated = $button.hasClass('active');

                    // Change to view mode columns that are in edit mode.
                    Edit.reset($table.find('td.tabledit-edit-mode'));

                    if (!activated) {
                        // Change to edit mode for all columns in reverse way.
                        $($button.parents('tr').find('td.tabledit-view-mode').get().reverse()).each(function() {
                            Mode.edit(this);
                        });
                    }

                    event.handled = true;
                }
            });

            /**
             * Save edited row.
             *
             * @param {object} event
             */
            $table.on('click', 'button.tabledit-save-button', function(event) {
                if (event.handled !== true) {
                    event.preventDefault();

                    // Submit and update all columns.
                    Edit.submit($(this).parents('tr').find('td.tabledit-edit-mode'));

                    event.handled = true;
                }
            });
        } else {
            /**
             * Change to edit mode on table td element.
             *
             * @param {object} event
             */
            $table.on(settings.eventType, 'tr:not(.tabledit-deleted-row) td.tabledit-view-mode', function(event) {
                if (event.handled !== true) {
                    event.preventDefault();

                    // Reset all td's in edit mode.
                    Edit.reset($table.find('td.tabledit-edit-mode'));

                    // Change to edit mode.
                    Mode.edit(this);

                    event.handled = true;
                }
            });

            /**
             * Change event when input is a select element.
             */
            $table.on('change', 'select.tabledit-input:visible', function() {
                if (event.handled !== true) {
                    // Submit and update the column.
                    Edit.submit($(this).parent('td'));

                    event.handled = true;
                }
            });

            /**
             * Click event on document element.
             *
             * @param {object} event
             */
            $(document).on('click', function(event) {
                var $editMode = $table.find('.tabledit-edit-mode');
                // Reset visible edit mode column.
                if (!$editMode.is(event.target) && $editMode.has(event.target).length === 0) {
                    Edit.reset($table.find('.tabledit-input:visible').parent('td'));
                }
            });
        }

        /**
         * Keyup event on document element.
         *
         * @param {object} event
         */
        $(document).on('keyup', function(event) {
            // Get input element with focus or confirmation button.
            var $input = $table.find('.tabledit-input:visible');
            var $button = $table.find('.tabledit-confirm-button');

            if ($input.length > 0) {
                var $td = $input.parents('td');
            } else if ($button.length > 0) {
                var $td = $button.parents('td');
            } else {
                return;
            }

            // Key?
            switch (event.keyCode) {
                case 9:  // Tab.
                    if (!settings.editButton) {
                        Edit.submit($td);
                        Mode.edit($td.closest('td').next());
                    }
                    break;
                case 13: // Enter.
                    //Edit.submit($td);
                    break;
                case 27: // Escape.
                    Edit.reset($td);
                    Delete.reset($td);
                    break;
            }
        });



        //MANAGE ADDING NEW BOOKINGS
        $('#addNewBookingBtn').on( 'click', function () {

            // Hide add new booking btn
            $('#addNewBookingBtn').hide();

            var newBookingErrorBlocHeader='<aside class="text-center alert alert-danger alert-dismissible" role="alert">' +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '<strong>Il y a des erreurs dans le formulaire</strong>' +
                '<ul>';
            var newBookingErrorBlocFooter = '</ul></aside>';
            var newBookingErrorBlocBody = '<li>{{ $error }}</li>';

            var newBookingBox ='' +
                '<div id="newBookingTable"> <div class="box-header"> <h3 class="box-title">Nouvelle réservation</h3></div>'+
                '<div class="box-body table-responsive"> <table id="newBookingTable" class="table table-striped table-bordered" cellspacing="0" width="100%">'+
                '<thead><th>Nom</th><th>Téléphone</th> <th>Date réservée</th> <th>Heure réservée</th><th>Personnes</th><th>Valider / Annuler</th></thead>' +
                '<tbody><tr></tr></tbody></table> </div></div>';

            $('#bookingListBox .new-btn').prepend(newBookingBox);

            var $tr = $('#newBookingTable tbody').prepend('<tr />').children('tr:first');
            // --- Create text input elements ---
            //customer
            var input = '<input class="tabledit-input ' + settings.inputClass + '" type="text" required name="name"  id="name" placeholder="nom"><p id="errorName" style="color:red;"></p>';
            $tr.append('<td name="organizer">'+input+'</td>');

            //phone
            input = '<input class="tabledit-input ' + settings.inputClass + '" type="number" required min="10"  name="phone"  id="phone" placeholder="0601234567"><p id="errorPhone" style="color:red;"></p>';
            $tr.append('<td name="phone">'+input+'</td>');

            //date booking
            input =  '<input data-value="" class="form-control target-date"  type="text" required name="date" id="date" placeholder="Date de réservation"><p id="errorDate" style="color:red;"></p>';
            $tr.append('<td name="dateColumn">'+input+'</td>');
            $('input[name="date"]').pickadate(optionsDatePicker);

            //time booking
            var select = '<select class="form-control" required  name="time" id="time" ><option >Choissiez le jour</option></select><p id="errorTime"></p>';
            $tr.append('<td name="timeColumn">'+select+'</td>');

            // guests select element
            var select = '<select class="form-control" name="guests" id="guests">';
            $.each(jQuery.parseJSON(settings.columns.editable[0][2]), function (index, value) {
                select += '<option value="' + index + '">' + value + '</option>';
            });
            select += '</select>';
            $tr.append('<td name="guests">'+select+'</td>');

            // btns
            input = '<button id="confirmBookingBtn"  type="button" class="tabledit-save-button btn  btn-sm btn-success" style="margin: 0px 5px 0px 5px;">Valider</button>';
            input += '<button id="cancelBookingBtn" type="button" class="tabledit-save-button btn  btn-sm btn-danger" style="margin: 0px 5px 0px 5px;">Annuler</button>';
            $tr.append('<td>'+input+'</td>');

            $('#cancelBookingBtn').on( 'click', function () {
                // Hide add new booking btn
                $('#addNewBookingBtn').show();
                $('#newBookingTable').remove();
            });

            $('#confirmBookingBtn').on( 'click', function () {
                //Validation form input
                var inpObj = document.getElementById("name");
                if (!inpObj.checkValidity()) {
                    document.getElementById("errorName").innerHTML = inpObj.validationMessage;
                    return false;
                }else{
                    document.getElementById("errorName").innerHTML = "";
                }
                var inpObj = document.getElementById("phone");
                if (!inpObj.checkValidity()) {
                    document.getElementById("errorPhone").innerHTML = inpObj.validationMessage;
                    return false;
                }else{
                    document.getElementById("errorPhone").innerHTML = "";
                }
                var time = $('select[name="time"]').val();
                if(time === 'Choissiez le jour'){
                    document.getElementById("errorDate").innerHTML = "Séléctionner votre date";
                    return false;
                }
                // Send AJAX request to server.
                var ajaxResult = ajax(settings.buttons.create.action);
                // Hide add new booking btn
                $('#addNewBookingBtn').show();
                $('#newBookingTable').remove();
                window.location.reload();
            });


        } );



        return this;
    };
}(jQuery));