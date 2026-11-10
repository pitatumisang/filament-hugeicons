# Default icon coverage

Generated against Filament v5.11.2. This reports the installed version, not a tested compatibility matrix.

Run `php scripts/alias-coverage.php` to regenerate; `php scripts/alias-coverage.php --check` checks drift without writing.

Coverage: 81 mapped / 221 canonical aliases. Deprecated constants are excluded; equivalent alias values are counted once. Unmapped aliases retain their Filament defaults.

Mappings are curated for common interface roles. Specialized editors and uncertain equivalents are intentionally omitted. Directional controls include separate RTL mappings. Replacement is optional and application-wide; see the README for opt-in and override precedence.

## `Filament\Actions\View\ActionsIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `ACTION_GROUP` | `actions::action-group` | Unmapped |
| `CREATE_ACTION_GROUPED` | `actions::create-action.grouped` | `Add01` |
| `DELETE_ACTION` | `actions::delete-action` | `Delete02` |
| `DELETE_ACTION_GROUPED` | `actions::delete-action.grouped` | `Delete02` |
| `DELETE_ACTION_MODAL` | `actions::delete-action.modal` | `Delete02` |
| `DETACH_ACTION` | `actions::detach-action` | Unmapped |
| `DETACH_ACTION_MODAL` | `actions::detach-action.modal` | Unmapped |
| `DISSOCIATE_ACTION` | `actions::dissociate-action` | Unmapped |
| `DISSOCIATE_ACTION_MODAL` | `actions::dissociate-action.modal` | Unmapped |
| `EDIT_ACTION` | `actions::edit-action` | `PencilEdit01` |
| `EDIT_ACTION_GROUPED` | `actions::edit-action.grouped` | `PencilEdit01` |
| `EXPORT_ACTION_GROUPED` | `actions::export-action.grouped` | `Download01` |
| `FORCE_DELETE_ACTION` | `actions::force-delete-action` | Unmapped |
| `FORCE_DELETE_ACTION_GROUPED` | `actions::force-delete-action.grouped` | Unmapped |
| `FORCE_DELETE_ACTION_MODAL` | `actions::force-delete-action.modal` | Unmapped |
| `IMPORT_ACTION_GROUPED` | `actions::import-action.grouped` | `Upload01` |
| `MODAL_CONFIRMATION` | `actions::modal.confirmation` | `Alert02` |
| `REPLICATE_ACTION` | `actions::replicate-action` | `Copy01` |
| `REPLICATE_ACTION_GROUPED` | `actions::replicate-action.grouped` | `Copy01` |
| `RESTORE_ACTION` | `actions::restore-action` | `RestoreBin` |
| `RESTORE_ACTION_GROUPED` | `actions::restore-action.grouped` | `RestoreBin` |
| `RESTORE_ACTION_MODAL` | `actions::restore-action.modal` | `RestoreBin` |
| `VIEW_ACTION` | `actions::view-action` | `View` |
| `VIEW_ACTION_GROUPED` | `actions::view-action.grouped` | `View` |

## `Filament\Forms\View\FormsIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `COMPONENTS_BUILDER_ACTIONS_CLONE` | `forms::components.builder.actions.clone` | `Copy01` |
| `COMPONENTS_BUILDER_ACTIONS_COLLAPSE` | `forms::components.builder.actions.collapse` | `ArrowUp01` |
| `COMPONENTS_BUILDER_ACTIONS_DELETE` | `forms::components.builder.actions.delete` | `Delete02` |
| `COMPONENTS_BUILDER_ACTIONS_EDIT` | `forms::components.builder.actions.edit` | Unmapped |
| `COMPONENTS_BUILDER_ACTIONS_EXPAND` | `forms::components.builder.actions.expand` | `ArrowDown01` |
| `COMPONENTS_BUILDER_ACTIONS_MOVE_DOWN` | `forms::components.builder.actions.move-down` | `ArrowDown02` |
| `COMPONENTS_BUILDER_ACTIONS_MOVE_UP` | `forms::components.builder.actions.move-up` | `ArrowUp02` |
| `COMPONENTS_BUILDER_ACTIONS_REORDER` | `forms::components.builder.actions.reorder` | `DragDropVertical` |
| `COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD` | `forms::components.checkbox-list.search-field` | `Search01` |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_DRAG_CROP` | `forms::components.file-upload.editor.actions.drag-crop` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_DRAG_MOVE` | `forms::components.file-upload.editor.actions.drag-move` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_FLIP_HORIZONTAL` | `forms::components.file-upload.editor.actions.flip-horizontal` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_FLIP_VERTICAL` | `forms::components.file-upload.editor.actions.flip-vertical` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_DOWN` | `forms::components.file-upload.editor.actions.move-down` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_LEFT` | `forms::components.file-upload.editor.actions.move-left` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_RIGHT` | `forms::components.file-upload.editor.actions.move-right` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_MOVE_UP` | `forms::components.file-upload.editor.actions.move-up` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ROTATE_LEFT` | `forms::components.file-upload.editor.actions.rotate-left` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ROTATE_RIGHT` | `forms::components.file-upload.editor.actions.rotate-right` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ZOOM_100` | `forms::components.file-upload.editor.actions.zoom-100` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ZOOM_IN` | `forms::components.file-upload.editor.actions.zoom-in` | Unmapped |
| `COMPONENTS_FILE_UPLOAD_EDITOR_ACTIONS_ZOOM_OUT` | `forms::components.file-upload.editor.actions.zoom-out` | Unmapped |
| `COMPONENTS_KEY_VALUE_ACTIONS_DELETE` | `forms::components.key-value.actions.delete` | `Delete02` |
| `COMPONENTS_KEY_VALUE_ACTIONS_REORDER` | `forms::components.key-value.actions.reorder` | Unmapped |
| `COMPONENTS_MODAL_TABLE_SELECT_ACTIONS_SELECT` | `forms::components.modal-table-select.actions.select` | Unmapped |
| `COMPONENTS_REPEATER_ACTIONS_CLONE` | `forms::components.repeater.actions.clone` | `Copy01` |
| `COMPONENTS_REPEATER_ACTIONS_COLLAPSE` | `forms::components.repeater.actions.collapse` | `ArrowUp01` |
| `COMPONENTS_REPEATER_ACTIONS_DELETE` | `forms::components.repeater.actions.delete` | `Delete02` |
| `COMPONENTS_REPEATER_ACTIONS_EXPAND` | `forms::components.repeater.actions.expand` | `ArrowDown01` |
| `COMPONENTS_REPEATER_ACTIONS_MOVE_DOWN` | `forms::components.repeater.actions.move-down` | `ArrowDown02` |
| `COMPONENTS_REPEATER_ACTIONS_MOVE_UP` | `forms::components.repeater.actions.move-up` | `ArrowUp02` |
| `COMPONENTS_REPEATER_ACTIONS_REORDER` | `forms::components.repeater.actions.reorder` | `DragDropVertical` |
| `COMPONENTS_RICH_EDITOR_PANELS_CUSTOM_BLOCK_DELETE_BUTTON` | `forms::components.rich-editor.panels.custom-block.delete-button` | Unmapped |
| `COMPONENTS_RICH_EDITOR_PANELS_CUSTOM_BLOCK_EDIT_BUTTON` | `forms::components.rich-editor.panels.custom-block.edit-button` | Unmapped |
| `COMPONENTS_RICH_EDITOR_PANELS_CUSTOM_BLOCKS_CLOSE_BUTTON` | `forms::components.rich-editor.panels.custom-blocks.close-button` | Unmapped |
| `COMPONENTS_RICH_EDITOR_PANELS_MERGE_TAGS_CLOSE_BUTTON` | `forms::components.rich-editor.panels.merge-tags.close-button` | Unmapped |
| `COMPONENTS_SELECT_ACTIONS_CREATE_OPTION` | `forms::components.select.actions.create-option` | `Add01` |
| `COMPONENTS_SELECT_ACTIONS_EDIT_OPTION` | `forms::components.select.actions.edit-option` | `PencilEdit01` |
| `COMPONENTS_TEXT_INPUT_ACTIONS_COPY` | `forms::components.text-input.actions.copy` | `Copy01` |
| `COMPONENTS_TEXT_INPUT_ACTIONS_HIDE_PASSWORD` | `forms::components.text-input.actions.hide-password` | `ViewOffSlash` |
| `COMPONENTS_TEXT_INPUT_ACTIONS_SHOW_PASSWORD` | `forms::components.text-input.actions.show-password` | `View` |
| `COMPONENTS_TOGGLE_BUTTONS_BOOLEAN_FALSE` | `forms::components.toggle-buttons.boolean.false` | `CancelCircle` |
| `COMPONENTS_TOGGLE_BUTTONS_BOOLEAN_TRUE` | `forms::components.toggle-buttons.boolean.true` | `CheckmarkCircle01` |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ALIGN_CENTER` | `forms:components.rich-editor.toolbar.align-center` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ALIGN_END` | `forms:components.rich-editor.toolbar.align-end` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ALIGN_JUSTIFY` | `forms:components.rich-editor.toolbar.align-justify` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ALIGN_START` | `forms:components.rich-editor.toolbar.align-start` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ATTACH_FILES` | `forms:components.rich-editor.toolbar.attach-files` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_BLOCKQUOTE` | `forms:components.rich-editor.toolbar.blockquote` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_BOLD` | `forms:components.rich-editor.toolbar.bold` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_BULLET_LIST` | `forms:components.rich-editor.toolbar.bullet-list` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_CLEAR_FORMATTING` | `forms:components.rich-editor.toolbar.clear_formatting` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_CODE` | `forms:components.rich-editor.toolbar.code` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_CODE_BLOCK` | `forms:components.rich-editor.toolbar.code-block` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_CUSTOM_BLOCKS` | `forms:components.rich-editor.toolbar.custom-blocks` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_DETAILS` | `forms:components.rich-editor.toolbar.details` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_GRID` | `forms:components.rich-editor.toolbar.grid` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_GRID_ADD_COLUMN_AFTER` | `forms:components.rich-editor.toolbar.grid_add_column_after` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_GRID_ADD_COLUMN_BEFORE` | `forms:components.rich-editor.toolbar.grid_add_column_before` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_GRID_DELETE` | `forms:components.rich-editor.toolbar.grid_delete` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_GRID_DELETE_COLUMN` | `forms:components.rich-editor.toolbar.grid_delete_column` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_H1` | `forms:components.rich-editor.toolbar.h1` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_H2` | `forms:components.rich-editor.toolbar.h2` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_H3` | `forms:components.rich-editor.toolbar.h3` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_H4` | `forms:components.rich-editor.toolbar.h4` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_H5` | `forms:components.rich-editor.toolbar.h5` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_H6` | `forms:components.rich-editor.toolbar.h6` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_HIGHLIGHT` | `forms:components.rich-editor.toolbar.highlight` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_HORIZONTAL_RULE` | `forms:components.rich-editor.toolbar.horizontal-rule` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ITALIC` | `forms:components.rich-editor.toolbar.italic` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_LEAD` | `forms:components.rich-editor.toolbar.lead` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_LINK` | `forms:components.rich-editor.toolbar.link` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_MERGE_TAGS` | `forms:components.rich-editor.toolbar.merge-tags` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_ORDERED_LIST` | `forms:components.rich-editor.toolbar.ordered-list` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_PARAGRAPH` | `forms:components.rich-editor.toolbar.paragraph` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_REDO` | `forms:components.rich-editor.toolbar.redo` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_SMALL` | `forms:components.rich-editor.toolbar.small` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_STRIKE` | `forms:components.rich-editor.toolbar.strike` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_SUBSCRIPT` | `forms:components.rich-editor.toolbar.subscript` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_SUPERSCRIPT` | `forms:components.rich-editor.toolbar.superscript` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE` | `forms:components.rich-editor.toolbar.table` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_ADD_COLUMN_AFTER` | `forms:components.rich-editor.toolbar.table_add_column_after` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_ADD_COLUMN_BEFORE` | `forms:components.rich-editor.toolbar.table_add_column_before` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_ADD_ROW_AFTER` | `forms:components.rich-editor.toolbar.table_add_row_after` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_ADD_ROW_BEFORE` | `forms:components.rich-editor.toolbar.table_add_row_before` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_DELETE` | `forms:components.rich-editor.toolbar.table_delete` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_DELETE_COLUMN` | `forms:components.rich-editor.toolbar.table_delete_column` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_DELETE_ROW` | `forms:components.rich-editor.toolbar.table_delete_row` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_MERGE_CELLS` | `forms:components.rich-editor.toolbar.table_merge_cells` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_SPLIT_CELL` | `forms:components.rich-editor.toolbar.table_split_cell` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_TOGGLE_HEADER_CELL` | `forms:components.rich-editor.toolbar.table_toggle_header_cell` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TABLE_TOGGLE_HEADER_ROW` | `forms:components.rich-editor.toolbar.table_toggle_header_row` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_TEXT_COLOR` | `forms:components.rich-editor.toolbar.text-color` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_UNDERLINE` | `forms:components.rich-editor.toolbar.underline` | Unmapped |
| `COMPONENTS_RICH_EDITOR_TOOLBAR_UNDO` | `forms:components.rich-editor.toolbar.undo` | Unmapped |

## `Filament\Infolists\View\InfolistsIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `COMPONENTS_ICON_ENTRY_FALSE` | `infolists::components.icon-entry.false` | Unmapped |
| `COMPONENTS_ICON_ENTRY_TRUE` | `infolists::components.icon-entry.true` | Unmapped |

## `Filament\Notifications\View\NotificationsIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `DATABASE_MODAL_EMPTY_STATE` | `notifications::database.modal.empty-state` | Unmapped |
| `NOTIFICATION_CLOSE_BUTTON` | `notifications::notification.close-button` | `Cancel01` |
| `NOTIFICATION_DANGER` | `notifications::notification.danger` | `CancelCircle` |
| `NOTIFICATION_INFO` | `notifications::notification.info` | `InformationCircle` |
| `NOTIFICATION_SUCCESS` | `notifications::notification.success` | `CheckmarkCircle01` |
| `NOTIFICATION_WARNING` | `notifications::notification.warning` | `Alert02` |

## `Filament\QueryBuilder\View\QueryBuilderIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `ADD_RULE_ACTION` | `query-builder::add-rule-action` | Unmapped |
| `CONSTRAINTS_BOOLEAN` | `query-builder::constraints.boolean` | Unmapped |
| `CONSTRAINTS_DATE` | `query-builder::constraints.date` | Unmapped |
| `CONSTRAINTS_NUMBER` | `query-builder::constraints.number` | Unmapped |
| `CONSTRAINTS_RELATIONSHIP` | `query-builder::constraints.relationship` | Unmapped |
| `CONSTRAINTS_SELECT` | `query-builder::constraints.select` | Unmapped |
| `CONSTRAINTS_TEXT` | `query-builder::constraints.text` | Unmapped |
| `OR_GROUP_ADD_GROUP_ACTION` | `query-builder::or-group.add-group-action` | Unmapped |
| `OR_GROUP_BLOCK` | `query-builder::or-group.block` | Unmapped |

## `Filament\Schemas\View\SchemasIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `COMPONENTS_CALLOUT_DANGER` | `schema::components.callout.danger` | Unmapped |
| `COMPONENTS_CALLOUT_INFO` | `schema::components.callout.info` | Unmapped |
| `COMPONENTS_CALLOUT_SUCCESS` | `schema::components.callout.success` | Unmapped |
| `COMPONENTS_CALLOUT_WARNING` | `schema::components.callout.warning` | Unmapped |
| `COMPONENTS_TABS_DROPDOWN_TRIGGER_BUTTON` | `schema::components.tabs.dropdown-trigger-button` | Unmapped |
| `COMPONENTS_TABS_MORE_TABS_BUTTON` | `schema::components.tabs.more-tabs-button` | Unmapped |
| `COMPONENTS_WIZARD_COMPLETED_STEP` | `schema::components.wizard.completed-step` | Unmapped |

## `Filament\Support\View\SupportIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `BREADCRUMBS_SEPARATOR` | `breadcrumbs.separator` | `ArrowRight01` |
| `BREADCRUMBS_SEPARATOR_RTL` | `breadcrumbs.separator.rtl` | `ArrowLeft01` |
| `MODAL_CLOSE_BUTTON` | `modal.close-button` | `Cancel01` |
| `PAGINATION_FIRST_BUTTON` | `pagination.first-button` | `ArrowLeftDouble` |
| `PAGINATION_FIRST_BUTTON_RTL` | `pagination.first-button.rtl` | `ArrowRightDouble` |
| `PAGINATION_LAST_BUTTON` | `pagination.last-button` | `ArrowRightDouble` |
| `PAGINATION_LAST_BUTTON_RTL` | `pagination.last-button.rtl` | `ArrowLeftDouble` |
| `PAGINATION_NEXT_BUTTON` | `pagination.next-button` | `ArrowRight01` |
| `PAGINATION_NEXT_BUTTON_RTL` | `pagination.next-button.rtl` | `ArrowLeft01` |
| `PAGINATION_PREVIOUS_BUTTON` | `pagination.previous-button` | `ArrowLeft01` |
| `PAGINATION_PREVIOUS_BUTTON_RTL` | `pagination.previous-button.rtl` | `ArrowRight01` |
| `SECTION_COLLAPSE_BUTTON` | `section.collapse-button` | `ArrowDown01` |

## `Filament\Tables\View\TablesIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `ACTIONS_COLUMN_MANAGER` | `tables::actions.column-manager` | Unmapped |
| `ACTIONS_DISABLE_REORDERING` | `tables::actions.disable-reordering` | Unmapped |
| `ACTIONS_ENABLE_REORDERING` | `tables::actions.enable-reordering` | Unmapped |
| `ACTIONS_FILTER` | `tables::actions.filter` | `FilterHorizontal` |
| `ACTIONS_GROUP` | `tables::actions.group` | Unmapped |
| `ACTIONS_OPEN_BULK_ACTIONS` | `tables::actions.open-bulk-actions` | Unmapped |
| `COLUMNS_COLLAPSE_BUTTON` | `tables::columns.collapse-button` | Unmapped |
| `COLUMNS_ICON_COLUMN_FALSE` | `tables::columns.icon-column.false` | `CancelCircle` |
| `COLUMNS_ICON_COLUMN_TRUE` | `tables::columns.icon-column.true` | `CheckmarkCircle01` |
| `EMPTY_STATE` | `tables::empty-state` | Unmapped |
| `FILTERS_REMOVE_ALL_BUTTON` | `tables::filters.remove-all-button` | `Cancel01` |
| `GROUPING_COLLAPSE_BUTTON` | `tables::grouping.collapse-button` | Unmapped |
| `HEADER_CELL_SORT_ASC_BUTTON` | `tables::header-cell.sort-asc-button` | `ArrowUp02` |
| `HEADER_CELL_SORT_BUTTON` | `tables::header-cell.sort-button` | `ArrowUpDown` |
| `HEADER_CELL_SORT_DESC_BUTTON` | `tables::header-cell.sort-desc-button` | `ArrowDown02` |
| `REORDER_HANDLE` | `tables::reorder.handle` | `DragDropVertical` |
| `SEARCH_FIELD` | `tables::search-field` | `Search01` |

## `Filament\View\PanelsIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_DISABLE` | `panels::auth.multi-factor.app.actions.disable` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_DISABLE_MODAL` | `panels::auth.multi-factor.app.actions.disable.modal` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_DISABLE_NOTIFICATION` | `panels::auth.multi-factor.app.actions.disable.notification` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_REGENERATE_RECOVERY_CODES` | `panels::auth.multi-factor.app.actions.regenerate-recovery-codes` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_REGENERATE_RECOVERY_CODES_MODAL` | `panels::auth.multi-factor.app.actions.regenerate-recovery-codes.modal` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_REGENERATE_RECOVERY_CODES_NOTIFICATION` | `panels::auth.multi-factor.app.actions.regenerate-recovery-codes.notification` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_SET_UP` | `panels::auth.multi-factor.app.actions.set-up` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_SET_UP_MODAL` | `panels::auth.multi-factor.app.actions.set-up.modal` | Unmapped |
| `AUTH_MULTI_FACTOR_APP_ACTIONS_SET_UP_NOTIFICATION` | `panels::auth.multi-factor.app.actions.set-up.notification` | Unmapped |
| `AUTH_MULTI_FACTOR_EMAIL_ACTIONS_DISABLE` | `panels::auth.multi-factor.email.actions.disable` | Unmapped |
| `AUTH_MULTI_FACTOR_EMAIL_ACTIONS_DISABLE_MODAL` | `panels::auth.multi-factor.email.actions.disable.modal` | Unmapped |
| `AUTH_MULTI_FACTOR_EMAIL_ACTIONS_DISABLE_NOTIFICATION` | `panels::auth.multi-factor.email.actions.disable.notification` | Unmapped |
| `AUTH_MULTI_FACTOR_EMAIL_ACTIONS_SET_UP` | `panels::auth.multi-factor.email.actions.set-up` | Unmapped |
| `AUTH_MULTI_FACTOR_EMAIL_ACTIONS_SET_UP_MODAL` | `panels::auth.multi-factor.email.actions.set-up.modal` | Unmapped |
| `AUTH_MULTI_FACTOR_EMAIL_ACTIONS_SET_UP_NOTIFICATION` | `panels::auth.multi-factor.email.actions.set-up.notification` | Unmapped |
| `GLOBAL_SEARCH_FIELD` | `panels::global-search.field` | `Search01` |
| `PAGES_DASHBOARD_ACTIONS_FILTER` | `panels::pages.dashboard.actions.filter` | `FilterHorizontal` |
| `PAGES_DASHBOARD_NAVIGATION_ITEM` | `panels::pages.dashboard.navigation-item` | `Home01` |
| `AUTH_PASSWORD_RESET_REQUEST_ACTIONS_LOGIN` | `panels::pages.password-reset.request-password-reset.actions.login` | Unmapped |
| `AUTH_PASSWORD_RESET_REQUEST_ACTIONS_LOGIN_RTL` | `panels::pages.password-reset.request-password-reset.actions.login.rtl` | Unmapped |
| `RESOURCES_PAGES_EDIT_RECORD_NAVIGATION_ITEM` | `panels::resources.pages.edit-record.navigation-item` | `PencilEdit01` |
| `RESOURCES_PAGES_MANAGE_RELATED_RECORDS_NAVIGATION_ITEM` | `panels::resources.pages.manage-related-records.navigation-item` | Unmapped |
| `RESOURCES_PAGES_VIEW_RECORD_NAVIGATION_ITEM` | `panels::resources.pages.view-record.navigation-item` | `View` |
| `SIDEBAR_COLLAPSE_BUTTON` | `panels::sidebar.collapse-button` | `ArrowLeft01` |
| `SIDEBAR_COLLAPSE_BUTTON_RTL` | `panels::sidebar.collapse-button.rtl` | `ArrowRight01` |
| `SIDEBAR_EXPAND_BUTTON` | `panels::sidebar.expand-button` | `ArrowRight01` |
| `SIDEBAR_EXPAND_BUTTON_RTL` | `panels::sidebar.expand-button.rtl` | `ArrowLeft01` |
| `SIDEBAR_GROUP_COLLAPSE_BUTTON` | `panels::sidebar.group.collapse-button` | `ArrowDown01` |
| `SIDEBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON` | `panels::sidebar.open-database-notifications-button` | `Notification01` |
| `SUB_NAVIGATION_MOBILE_MENU_BUTTON` | `panels::sub-navigation.mobile-menu.button` | Unmapped |
| `TENANT_MENU_BILLING_BUTTON` | `panels::tenant-menu.billing-button` | Unmapped |
| `TENANT_MENU_PROFILE_BUTTON` | `panels::tenant-menu.profile-button` | Unmapped |
| `TENANT_MENU_REGISTRATION_BUTTON` | `panels::tenant-menu.registration-button` | Unmapped |
| `TENANT_MENU_TOGGLE_BUTTON` | `panels::tenant-menu.toggle-button` | Unmapped |
| `THEME_SWITCHER_DARK_BUTTON` | `panels::theme-switcher.dark-button` | Unmapped |
| `THEME_SWITCHER_LIGHT_BUTTON` | `panels::theme-switcher.light-button` | Unmapped |
| `THEME_SWITCHER_SYSTEM_BUTTON` | `panels::theme-switcher.system-button` | Unmapped |
| `TOPBAR_CLOSE_SIDEBAR_BUTTON` | `panels::topbar.close-sidebar-button` | `Cancel01` |
| `TOPBAR_GROUP_TOGGLE_BUTTON` | `panels::topbar.group.toggle-button` | Unmapped |
| `TOPBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON` | `panels::topbar.open-database-notifications-button` | `Notification01` |
| `TOPBAR_OPEN_SIDEBAR_BUTTON` | `panels::topbar.open-sidebar-button` | `Menu01` |
| `USER_MENU_LOGOUT_BUTTON` | `panels::user-menu.logout-button` | `Logout01` |
| `USER_MENU_PROFILE_ITEM` | `panels::user-menu.profile-item` | Unmapped |
| `USER_MENU_TOGGLE_BUTTON` | `panels::user-menu.toggle-button` | Unmapped |
| `WIDGETS_ACCOUNT_LOGOUT_BUTTON` | `panels::widgets.account.logout-button` | `Logout01` |
| `WIDGETS_FILAMENT_INFO_OPEN_DOCUMENTATION_BUTTON` | `panels::widgets.filament-info.open-documentation-button` | Unmapped |
| `WIDGETS_FILAMENT_INFO_OPEN_GITHUB_BUTTON` | `panels::widgets.filament-info.open-github-button` | Unmapped |

## `Filament\Widgets\View\WidgetsIconAlias`

| Constant | Alias | Hugeicon |
| --- | --- | --- |
| `CHART_WIDGET_EMPTY_STATE` | `widgets::chart-widget.empty-state` | Unmapped |
| `CHART_WIDGET_FILTER` | `widgets::chart-widget.filter` | Unmapped |
