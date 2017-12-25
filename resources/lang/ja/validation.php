<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは正しいURLではありません。',
    'after'                => ':attributeは:dateより後の日付にしてください。',
    'after_or_equal'       => ':attributeは:date以降の日付にしてください。',
    'alpha'                => ':attributeは英字のみにしてください。',
    'alpha_dash'           => ':attributeは英数字とハイフンのみにしてください。',
    'alpha_num'            => ':attributeは英数字のみにしてください。',
    'array'                => ':attributeは配列にしてください。',
    'before'               => ':attributeは:dateより前の日付にしてください。',
    'before_or_equal'      => ':attributeは:date以前の日付にしてください。',
    'between'              => [
        'numeric' => ':attributeは:min〜:maxの間にしてください。',
        'file'    => ':attributeは:min〜:max KBまでのファイルにしてください。',
        'string'  => ':attributeは:min〜:max文字にしてください。',
        'array'   => ':attributeは:min〜:max個までにしてください。',
    ],
    'boolean'              => ':attributeはtrueかfalseにしてください。',
    'confirmed'            => ':attributeは確認項目と一致していません。',
    'date'                 => ':attributeは正しい日付形式ではありません。',
    'date_format'          => ':attributeは日付形式:formatと一致していません。',
    'different'            => ':attributeは:otherと違うものにしてください。',
    'digits'               => ':attributeは:digits桁にしてください',
    'digits_between'       => ':attributeは:min〜:max桁にしてください。',
    'dimensions'           => ':attributeは無効な画像サイズです。',
    'distinct'             => ':attributeは重複しています。',
    'email'                => ':attributeは正しいメールアドレス形式ではありません。',
    'exists'               => '選択された:attributeは正しくありません。',
    'file'                 => ':attributeはファイル形式ではありません。',
    'filled'               => ':attributeは必須項目です。',
    'image'                => ':attributeは画像形式ではありません。',
    'in'                   => '選択された:attributeは正しくありません。',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => ':attributeは整数にしてください。',
    'ip'                   => ':attributeは正しいIPアドレス形式ではありません。',
    'ipv4'                 => ':attributeは正しいIPアドレス形式ではありません。',
    'ipv6'                 => ':attributeは正しいIPアドレス形式ではありません。',
    'json'                 => ':attributeはJSON形式ではありません。',
    'max'                  => [
        'numeric' => ':attributeは:max以下にしてください。',
        'file'    => ':attributeは:max KB以下にしてください。',
        'string'  => ':attributeは:max文字以下にしてください。',
        'array'   => ':attributeは:max個以下にしてください。',
    ],
    'mimes'                => ':attributeは:valuesタイプのファイル形式ではありません。',
    'mimetypes'            => ':attributeは:valuesタイプのファイル形式ではありません。',
    'min'                  => [
        'numeric' => ':attributeは:min以上にしてください。',
        'file'    => ':attributeは:min KB以上にしてください。',
        'string'  => ':attributeは:min文字以上にしてください。',
        'array'   => ':attributeは:min個以上にしてください。',
    ],
    'not_in'               => '選択された:attributeは正しくありません。',
    'numeric'              => ':attributeは数字ではありません。',
    'present'              => ':attributeが存在しません。',
    'regex'                => ':attributeの形式は正しくありません。',
    'required'             => ':attributeは必須項目です。',
    'required_if'          => ':otherが:valueのとき:attributeは必須項目です。',
    'required_unless'      => ':otherが:valueではないとき:attributeは必須項目です。',
    'required_with'        => ':valuesが存在するとき:attributeは必須項目です。',
    'required_with_all'    => ':valuesが存在するとき:attributeは必須項目です。',
    'required_without'     => ':valuesが存在しないとき:attributeは必須項目です。',
    'required_without_all' => ':valuesが存在しないとき:attributeは必須項目です。',
    'same'                 => ':attributeと:otherは一致していません。',
    'size'                 => [
        'numeric' => ':attributeは:sizeにしてください。',
        'file'    => ':attributeは:size KBにしてください。',
        'string'  => ':attributeは:size文字にしてください。',
        'array'   => ':attributeは:size個にしてください。',
    ],
    'string'               => ':attributeは文字列ではありません。',
    'timezone'             => ':attributeはタイムゾーン形式ではありません。',
    'unique'               => ':attributeは既に存在しています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeはURL形式ではありません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
