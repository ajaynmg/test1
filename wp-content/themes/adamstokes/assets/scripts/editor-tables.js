if (tinymce) {
	tinymce.PluginManager.add('table', function(editor, url) {
		var menuItems = [];
		
		tinymce.each([
			{
				text: 'Basic',
				value: 'table',
			},
			{
				text: 'Bordered',
				value: 'table table-bordered',
			},
		], function(tableType) {
			menuItems.push({
				text: tableType.text,
				onclick: function() {
					editor.windowManager.open({
						title: 'Insert ' + tableType.text + ' Table',
						body: [
							{
								type: 'checkbox',
								name: 'thead',
								label: 'Add header row',
							},
							{
								type: 'checkbox',
								name: 'tfoot',
								label: 'Add footer row',
							},
							{
								type: 'textbox',
								name: 'rows',
								label: 'Rows',
							},
							{
								type: 'textbox',
								name: 'columns',
								label: 'Columns',
							},
						],
						onsubmit: function(table) {
							var isValidColumns = table.data.columns.length > 0,
								isValidRows = table.data.rows.length > 0;
							if (isValidColumns && isValidRows) {
								var col,
									
									// Initialize table HTML string
									tableHtml = '<table class="' + tableType.value + '">';
								
								// Append header
								if (table.data.thead) {
									tableHtml += '<thead><tr>';
									
									// Append columns to match tbody
									for (col = 0; col < table.data.columns; col++) {
										tableHtml += '<td>replace_me</td>';
									}
									
									tableHtml += '</tr></thead>';
								}
								
								// Append rows
								tableHtml += '<tbody>';
								for (var row = 0; row < table.data.rows; row++) {
									tableHtml += '<tr>';
									
									// Append columns
									for (col = 0; col < table.data.columns; col++) {
										tableHtml += '<td>replace_me</td>';
									}
									tableHtml += '</tr>';
								}
								tableHtml += '</tbody>';
								
								// Append footer
								if (table.data.tfoot) {
									tableHtml += '<tfoot><tr>';
									
									// Append columns to match tbody
									for (col = 0; col < table.data.columns; col++) {
										tableHtml += '<td>replace_me</td>';
									}
									
									tableHtml += '</tr></tfoot>';
								}
								
								// Close table HTML string
								tableHtml += '</table>';
								
								// Insert into content editor
								editor.insertContent(tableHtml);
							} else {
								var alertMsg = '',
									invalidFields = [];
								
								if (!isValidRows) {
									invalidFields.push('Rows');
								}
								if (!isValidColumns) {
									invalidFields.push('Columns');
								}
								
								if (invalidFields.length > 1) {
									alertMsg = invalidFields.join(' and ') + ' are required.';
								} else {
									alertMsg = invalidFields.join('') + ' is required.';
								}
								tinymce.activeEditor.windowManager.alert(alertMsg);
								return false;
							}
						},
					});
				},
			});
		});
		
		editor.addButton('table', {
			type: 'menubutton',
			text: 'Table',
			icon: false,
			menu: menuItems,
		});
		
		editor.addMenuItem('tableDropDownMenu', {
			icon: false,
			text: 'Table',
			menu: menuItems,
			context: 'insert',
			prependToContext: true,
		});
	});
}