<?php
/**
 * Routing Helpers
 *
 */
function rrn()
{
    // resource routingでprefixを有効化させるため明示的に名前を定義
    return [
        'names' => [
            'index'   => '.index',
            'create'  => '.create',
            'store'   => '.store',
            'show'    => '.show',
            'edit'    => '.edit',
            'update'  => '.update',
            'destroy' => '.destroy'
        ]
    ];
}

// resource routingのonly定義のショートカット
function rrn_only()
{
    return array_merge(rrn(), ['only' => func_get_args()]);
}

// resource routingのexcept定義のショートカット
function rrn_except()
{
    return array_merge(rrn(), ['except' => func_get_args()]);
}

/**
 * Flash Message
 *
 */
function set_success($message)
{
    \Session::flash('flash_success', is_array($message) ? $message : [$message]);
}

function set_warning($message)
{
    \Session::flash('flash_warning', is_array($message) ? $message : [$message]);
}

function set_error($message)
{
    \Session::flash('flash_error', is_array($message) ? $message : [$message]);
}

//　カテゴリー一覧を取得
function categories()
{
    $list = \App\Category::all();
    return $list;
}
