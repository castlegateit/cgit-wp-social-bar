<div class="wrap">
    <h1>Social Bar</h1>

    <p>Click and drag to enable, disable, and sort the social bar links.</p>

    <div class="cgit-wp-social-bar-settings">
        <form action="" method="post" class="cgit-wp-social-bar-settings__form">
            <input type="hidden" name="form_id" value="<?= $form_id ?>">

            <div class="cgit-wp-social-bar-settings__section">
                <div class="cgit-wp-social-bar-settings__grid">
                    <div class="cgit-wp-social-bar-settings__column">
                        <h2 class="cgit-wp-social-bar-settings__heading">Enabled</h2>

                        <ul class="cgit-wp-social-bar-settings__list cgit-wp-social-bar-settings__list--enabled">
                            <?php

                            foreach ($sites as $key => $site) {
                                if (!$site['enabled']) {
                                    continue;
                                }

                                include __DIR__ . '/settings-item.php';
                            }

                            ?>
                        </ul>
                    </div>

                    <div class="cgit-wp-social-bar-settings__column">
                        <h2 class="cgit-wp-social-bar-settings__heading">Disabled</h2>

                        <ul class="cgit-wp-social-bar-settings__list cgit-wp-social-bar-settings__list--disabled">
                            <?php

                            foreach ($sites as $key => $site) {
                                if ($site['enabled']) {
                                    continue;
                                }

                                include __DIR__ . '/settings-item.php';
                            }

                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="cgit-wp-social-bar-settings__section">
                <h2 class="cgit-wp-social-bar-settings__heading">Appearance</h2>

                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="cgit-wp-social-bar-position">Position</label>
                        </th>

                        <td>
                            <select name="position" id="cgit-wp-social-bar-position">
                                <?php

                                foreach ($available_positions as $key => $label) {
                                    $selected = '';

                                    if ($position === $key) {
                                        $selected = 'selected';
                                    }

                                    ?>
                                    <option value="<?= $key ?>" <?= $selected ?>>
                                        <?= $label ?>
                                    </option>
                                    <?php
                                }

                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <button type="submit" class="button button-primary">Save</button>
        </form>
    </div>
</div>
