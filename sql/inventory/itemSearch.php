<?php

    $itemDetailsSearchSql = 'SELECT * FROM pokemart_inventory';   
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();

    while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC))
    {
		
		$output .= '<tr>' .
						'<td>' . $row['product_id'] . '</td>' .
						'<td>' . $row['item_name'] . '</td>' .
						'<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $row['product_id'] . '">' . $row['item_name'] . '</a></td>' .
						'<td>' . $row['japanese_item_name'] . '</td>' .
                        '<td>' . $row['item_type'] . '</td>' .
                        '<td>' . $row['selling_price'] . '</td>' .
						'<td>' . $row['cost'] . '</td>' .
                        '<td>' . $row['in_stock'] . '</td>' .
						'<td>' . $row['reorder_amount'] . '</td>' .
                        '<td>' . $row['base_stock'] . '</td>' .
						'<td>' . $row['description'] . '</td>' .
					'</tr>';
	}

    $itemDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Product ID</th>
							<th>Item Name</th>
                            <th>Japanese Name</th>
							<th>Type</th>
                            <th>Selling Price</th>
                            <th>Unit Price</th>
							<th>Stock</th>
							<th>Reorder Amount</th>
                            <th>Base Stock</th>
							<th>Description</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;

?>