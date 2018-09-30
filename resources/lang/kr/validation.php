<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 유효성 검사 언어 라인
    |--------------------------------------------------------------------------
    |
    | 다음 언어 행에는 유효성 검사기 클래스에서 사용되는 기본 오류 메시지가 들어 있습니다. 이러한 사이 규칙 중 일부는 사이즈 규칙과 같은 여러 버전이 있습니다. 이 메시지 각각을 여기에서 비틀할 수 있습니다.
    |
    */
    'unique_wallet' => '이 지갑은 이미 사용합니다.', 'unique_wallet_update' => '이 지갑은 이미 사용합니다.',
    'accepted' => '캡차를 받아 들여야합니다.',
    'active_url' => ': 속성은 유효한 URL이 아닙니다.',
    'after' => ': 속성은 날짜 이후 여야합니다.',
    'after_or_equal' => '속성은 날짜 이후 여야합니다 아니면 동일한 날에 해야합니다',
    'alpha' => ': 특성은 문자 만 가튼 포함 할 수 있습니다.',
    'alpha_dash' => ': 속성은 문자, 숫자 및 대시 만 포함 할 수 있습니다.',
    'alpha_num' => ': 속성은 문자와 숫자 만 포함 할 수 있습니다.',
    'array' => ': 속성은 배열이어야합니다.',
    'before' => ': 속성은 날짜 이전: 날짜 여야합니다.',
    'before_or_equal' => ': 속성은 날짜 이전 또는 동일한 날짜 여야합니다 :',
    'between' => [
        'numeric' => ': 속성은 최소와 최대 사이에 있어야합니다.',
        'file' => ': 속성은 다음 중 하나 여야합니다: 최저와최대한으로 킬로바이트.',
        'string' => ': 속성은 최소와 최대 사이의 문자 여야합니다.',
        'array' => ': 속성은 최소와 최대 항목 사이에 있어야합니다.',],
    'boolean' => ': 속성 필드는 참 또는 거짓 여야합니다.',
    'confirmed' => '필드가 서로 일치하지 않습니다.',
    'date' => ': 속성은 유효한 날짜가 아닙니다.',
    'date_format' => ': 속성이 형식: 형식과 일치하지 않습니다.',
    'different' => ': 속성과 : 다른 는 달라야합니다.',
    'digits' => ': 속성은 반드시 숫자 여야합니다.',
    'digits_between' => ': 속성은 최소값과: 최대 값 사이에 있어야합니다.',
    'dimensions' => ': 속성의 이미지 크기가 잘못되었습니다',
    'distinct' => ': 속성 필드에 중복 값이 있습니다.',
    'email' => '이메일 주소는 기호를 포함해야합니다 "@".',
    'exists' => '선택된 속성이 유효하지 않습니다.',
    'file' => ': 속성은 파일이어야합니다.',
    'filled' => ': 속성 필드에는 값이 있어야합니다.',
    'image' => ': 속성은 이미지 여야합니다.',
    'in' => '선택된: 속성이 유효하지 않습니다.',
    'in_array' => ': 속성 필드가 존재하지 않습니다 : 다른.',
    'integer' => ': 속성은 정수 여야합니다.',
    'ip' => ': 속성은 유효한 IP 주소 여야합니다.', 'ipv4' => ': 속성은 유효한 IPv4 주소 여야합니다.',
    'ipv6' => ': 속성은 유효한 IPv6 주소 여야합니다.', 'json' => ': 속성은 유효한 JSON 문자열이어야합니다.',
    'max' => [
        'numeric' => ': 속성은 다음보다 클 수 없습니다. :최대.',
        'file' => ': 속성은 최대 킬로바이트보다 클 수 없습니다.', 'string' => '이 입력란은 최대 문자 수보다 커야할수없읍니다.',
        'array' => ': 속성은 최대 항목보다 많을 수 없습니다.',
    ],
    'mimes' => ': 속성은 반드시 : 형식의 파일이어야합니다 : 가치. ',
    'mimetypes' => ': 속성은 반드시 : 형식의 파일이어야합니다 : 가치. ',
    'min' => [
        'numeric' => ': 속성은 적어도 다음과 같아야합니다 : 최소.',
        'file' => ': 속성은 적어도 다음과 같아야합니다 : 최소 킬로바이트',
        'string' => '이 필드는 최소한이어야합니다 : 최소 문자.',
        'array' => ': 속성은 최소한 : 최소 항목이 있어야합니다.',
    ],
    'not_in' => '선택된: 속성이 잘못되었습니다.',
    'numeric' => ' : 속성은 숫자 여야합니다..',
    'present' => ': 속성 필드가 지금은 있어야합니다.',
    'regex' => ': 속성 형식이 잘못되었습니다.',
    'required' => '필드가 필요합니다.',
    'required_if' => ': 속성 필드는 다음과 같은 경우 필수입니다. 가치는 다른것이다',
    'required_unless' => '다른 것은 값 내에 있으면 속성 필드가 필요합니다.',
    'required_with' => ': 속성 필드는 값이 지금은 있을 때 필요합니다.',
    'required_with_all' => '값이 지금은 있을 때 속성 필드가 필요합니다.',
    'required_without' => '값이 지금은 아니고 있을 때 속성 필드가 필요합니다.',
    'required_without_all' => ': 속성 필드는 : 값이 없을 때 필요합니다.', 'same' => ': 속성 및 기타 일치해야합니다.',
    'size' => [
        'numeric' => ': 속성은 크기 여야합니다.',
        'file' => ': 속성은 크기 킬로바이트 여야합니다.',
        'string' => ' : 속성은 크기 문자 여야합니다.',
        'array' => ': 속성은 크기 항목을 포함해야합니다.',
    ],
    'string' => ': 속성은 문자열이어야합니다.',
    'timezone' => ': 속성은 유효한 지역이어야합니다.',
    'unique' => '속성이 이미 사용되었습니다.',
    'uploaded' => ': 속성을 업로드 할 수 없습니다.',
    'url' => ': 속성 형식이 잘못되었습니다.',

    /*
    |--------------------------------------------------------------------------
    | 사용자 정의 유효성 검사 언어 라인
    |--------------------------------------------------------------------------
    |
    | 여기서 속성에 대한 사용자 정의 유효성 검사 메시지를 지정할 수 있으면서협약 "attribute.rule" 사용으로 선 이름 지정 주세요. 이를 통해 특정 속성 규칙에 대한 특정 사용자 정의 언어 행을 신속하게 지정할 수 있습니다.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => '맞춤 메시지',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 사용자 지정 유효성 검사 특성    |--------------------------------------------------------------------------
    |
    | 다음 언어 행은 속성 자리 표시자를 스왑 데 사용됩니다 독자가 읽기 편한 "전자 메일"대신 전자 메일 주소와 같은거시다.
 이것은 단순히 우리를 좀 더 깔끔하게 만듭니다.
    |
    */

    'attributes' => [],

];
