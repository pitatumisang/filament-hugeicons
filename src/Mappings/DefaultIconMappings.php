<?php

declare(strict_types=1);

namespace EnigmaInc\FilamentHugeicons\Mappings;

use EnigmaInc\FilamentHugeicons\Icons\Hugeicon;
use Filament\Actions\View\ActionsIconAlias;
use Filament\Forms\View\FormsIconAlias;
use Filament\Notifications\View\NotificationsIconAlias;
use Filament\Support\View\SupportIconAlias;
use Filament\Tables\View\TablesIconAlias;
use Filament\View\PanelsIconAlias;

final class DefaultIconMappings
{
    /** @return array<string, Hugeicon> */
    public static function all(): array
    {
        return [
            ActionsIconAlias::CREATE_ACTION_GROUPED => Hugeicon::Add01,
            ActionsIconAlias::DELETE_ACTION => Hugeicon::Delete02,
            ActionsIconAlias::DELETE_ACTION_GROUPED => Hugeicon::Delete02,
            ActionsIconAlias::DELETE_ACTION_MODAL => Hugeicon::Delete02,
            ActionsIconAlias::EDIT_ACTION => Hugeicon::PencilEdit01,
            ActionsIconAlias::EDIT_ACTION_GROUPED => Hugeicon::PencilEdit01,
            ActionsIconAlias::EXPORT_ACTION_GROUPED => Hugeicon::Download01,
            ActionsIconAlias::IMPORT_ACTION_GROUPED => Hugeicon::Upload01,
            ActionsIconAlias::MODAL_CONFIRMATION => Hugeicon::Alert02,
            ActionsIconAlias::REPLICATE_ACTION => Hugeicon::Copy01,
            ActionsIconAlias::REPLICATE_ACTION_GROUPED => Hugeicon::Copy01,
            ActionsIconAlias::RESTORE_ACTION => Hugeicon::RestoreBin,
            ActionsIconAlias::RESTORE_ACTION_GROUPED => Hugeicon::RestoreBin,
            ActionsIconAlias::RESTORE_ACTION_MODAL => Hugeicon::RestoreBin,
            ActionsIconAlias::VIEW_ACTION => Hugeicon::View,
            ActionsIconAlias::VIEW_ACTION_GROUPED => Hugeicon::View,
            FormsIconAlias::COMPONENTS_CHECKBOX_LIST_SEARCH_FIELD => Hugeicon::Search01,
            FormsIconAlias::COMPONENTS_KEY_VALUE_ACTIONS_DELETE => Hugeicon::Delete02,
            FormsIconAlias::COMPONENTS_TEXT_INPUT_ACTIONS_COPY => Hugeicon::Copy01,
            FormsIconAlias::COMPONENTS_TEXT_INPUT_ACTIONS_HIDE_PASSWORD => Hugeicon::ViewOffSlash,
            FormsIconAlias::COMPONENTS_TEXT_INPUT_ACTIONS_SHOW_PASSWORD => Hugeicon::View,
            FormsIconAlias::COMPONENTS_SELECT_ACTIONS_CREATE_OPTION => Hugeicon::Add01,
            FormsIconAlias::COMPONENTS_SELECT_ACTIONS_EDIT_OPTION => Hugeicon::PencilEdit01,
            FormsIconAlias::COMPONENTS_TOGGLE_BUTTONS_BOOLEAN_FALSE => Hugeicon::CancelCircle,
            FormsIconAlias::COMPONENTS_TOGGLE_BUTTONS_BOOLEAN_TRUE => Hugeicon::CheckmarkCircle01,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_CLONE => Hugeicon::Copy01,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_COLLAPSE => Hugeicon::ArrowUp01,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_DELETE => Hugeicon::Delete02,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_EXPAND => Hugeicon::ArrowDown01,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_MOVE_DOWN => Hugeicon::ArrowDown02,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_MOVE_UP => Hugeicon::ArrowUp02,
            FormsIconAlias::COMPONENTS_BUILDER_ACTIONS_REORDER => Hugeicon::DragDropVertical,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_CLONE => Hugeicon::Copy01,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_COLLAPSE => Hugeicon::ArrowUp01,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_DELETE => Hugeicon::Delete02,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_EXPAND => Hugeicon::ArrowDown01,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_MOVE_DOWN => Hugeicon::ArrowDown02,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_MOVE_UP => Hugeicon::ArrowUp02,
            FormsIconAlias::COMPONENTS_REPEATER_ACTIONS_REORDER => Hugeicon::DragDropVertical,
            NotificationsIconAlias::NOTIFICATION_CLOSE_BUTTON => Hugeicon::Cancel01,
            NotificationsIconAlias::NOTIFICATION_DANGER => Hugeicon::CancelCircle,
            NotificationsIconAlias::NOTIFICATION_INFO => Hugeicon::InformationCircle,
            NotificationsIconAlias::NOTIFICATION_SUCCESS => Hugeicon::CheckmarkCircle01,
            NotificationsIconAlias::NOTIFICATION_WARNING => Hugeicon::Alert02,
            SupportIconAlias::BREADCRUMBS_SEPARATOR => Hugeicon::ArrowRight01,
            SupportIconAlias::BREADCRUMBS_SEPARATOR_RTL => Hugeicon::ArrowLeft01,
            SupportIconAlias::MODAL_CLOSE_BUTTON => Hugeicon::Cancel01,
            SupportIconAlias::PAGINATION_FIRST_BUTTON => Hugeicon::ArrowLeftDouble,
            SupportIconAlias::PAGINATION_FIRST_BUTTON_RTL => Hugeicon::ArrowRightDouble,
            SupportIconAlias::PAGINATION_LAST_BUTTON => Hugeicon::ArrowRightDouble,
            SupportIconAlias::PAGINATION_LAST_BUTTON_RTL => Hugeicon::ArrowLeftDouble,
            SupportIconAlias::PAGINATION_NEXT_BUTTON => Hugeicon::ArrowRight01,
            SupportIconAlias::PAGINATION_NEXT_BUTTON_RTL => Hugeicon::ArrowLeft01,
            SupportIconAlias::PAGINATION_PREVIOUS_BUTTON => Hugeicon::ArrowLeft01,
            SupportIconAlias::PAGINATION_PREVIOUS_BUTTON_RTL => Hugeicon::ArrowRight01,
            SupportIconAlias::SECTION_COLLAPSE_BUTTON => Hugeicon::ArrowDown01,
            TablesIconAlias::ACTIONS_FILTER => Hugeicon::FilterHorizontal,
            TablesIconAlias::COLUMNS_ICON_COLUMN_FALSE => Hugeicon::CancelCircle,
            TablesIconAlias::COLUMNS_ICON_COLUMN_TRUE => Hugeicon::CheckmarkCircle01,
            TablesIconAlias::FILTERS_REMOVE_ALL_BUTTON => Hugeicon::Cancel01,
            TablesIconAlias::SEARCH_FIELD => Hugeicon::Search01,
            TablesIconAlias::HEADER_CELL_SORT_ASC_BUTTON => Hugeicon::ArrowUp02,
            TablesIconAlias::HEADER_CELL_SORT_DESC_BUTTON => Hugeicon::ArrowDown02,
            TablesIconAlias::HEADER_CELL_SORT_BUTTON => Hugeicon::ArrowUpDown,
            TablesIconAlias::REORDER_HANDLE => Hugeicon::DragDropVertical,
            PanelsIconAlias::GLOBAL_SEARCH_FIELD => Hugeicon::Search01,
            PanelsIconAlias::PAGES_DASHBOARD_ACTIONS_FILTER => Hugeicon::FilterHorizontal,
            PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM => Hugeicon::Home01,
            PanelsIconAlias::RESOURCES_PAGES_EDIT_RECORD_NAVIGATION_ITEM => Hugeicon::PencilEdit01,
            PanelsIconAlias::RESOURCES_PAGES_VIEW_RECORD_NAVIGATION_ITEM => Hugeicon::View,
            PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON => Hugeicon::ArrowLeft01,
            PanelsIconAlias::SIDEBAR_COLLAPSE_BUTTON_RTL => Hugeicon::ArrowRight01,
            PanelsIconAlias::SIDEBAR_EXPAND_BUTTON => Hugeicon::ArrowRight01,
            PanelsIconAlias::SIDEBAR_EXPAND_BUTTON_RTL => Hugeicon::ArrowLeft01,
            PanelsIconAlias::SIDEBAR_GROUP_COLLAPSE_BUTTON => Hugeicon::ArrowDown01,
            PanelsIconAlias::TOPBAR_CLOSE_SIDEBAR_BUTTON => Hugeicon::Cancel01,
            PanelsIconAlias::TOPBAR_OPEN_SIDEBAR_BUTTON => Hugeicon::Menu01,
            PanelsIconAlias::TOPBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON => Hugeicon::Notification01,
            PanelsIconAlias::SIDEBAR_OPEN_DATABASE_NOTIFICATIONS_BUTTON => Hugeicon::Notification01,
            PanelsIconAlias::USER_MENU_LOGOUT_BUTTON => Hugeicon::Logout01,
            PanelsIconAlias::WIDGETS_ACCOUNT_LOGOUT_BUTTON => Hugeicon::Logout01,
        ];
    }
}
