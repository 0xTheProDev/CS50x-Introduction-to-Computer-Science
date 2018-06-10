                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th> Date/Time </th>
                            <th> Symbol </th>
                            <th> Name </th>
                            <th> Action </th>
                            <th> Shares </th>
                            <th> Price </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($positions as $position): ?>

                        <tr>
                            <td><?= $position["date"] ?></td>
                            <td><?= $position["symbol"] ?></td>
                            <td><?= $position["name"] ?></td>
                            <td><?= $position["action"] ?></td>
                            <td><?= $position["shares"] ?></td>
                            <td>$<?= $position["price"] ?></td>
                        </tr>
                    <?php endforeach ?>
                    
                    </tbody>
                </table>
