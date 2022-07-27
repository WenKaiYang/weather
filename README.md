# Weather 天气查询

> 基于 高德开放平台 的 PHP 天气信息组件。

# 安装
---

```shell
composer require wenkaiyang/weather -vvv
```

# 配置
---

在使用本扩展之前，你需要去 高德开放平台 注册账号，然后创建应用，获取应用的 API Key。

# 使用
---

```shell
use WenKaiYang\Weather\Weather;

$key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

$weather = new Weather($key);
```

## 获取实时天气

```shell
$response = $weather->getWeather('深圳');
```

## 获取实时天气 示例

```shell
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "lives": [
        {
            "province": "广东",
            "city": "深圳市",
            "adcode": "440300",
            "weather": "晴",
            "temperature": "34",
            "winddirection": "北",
            "windpower": "≤3",
            "humidity": "54",
            "reporttime": "2022-07-27 16:00:45"
        }
    ]
}
```

## 获取近期天气预报

```shell
// 获取天气预报
$response = $weather->getWeather('深圳','all');

// 获取实时天气
$response = $w->getLiveWeather('深圳');

// 获取天气预报
$response = $w->getForecastsWeather('深圳');
```

## 获取近期天气预报 示例

```shell
{
    "status": "1",
    "count": "1",
    "info": "OK",
    "infocode": "10000",
    "forecasts": [
        {
            "city": "深圳市",
            "adcode": "440300",
            "province": "广东",
            "reporttime": "2022-07-27 16:00:45",
            "casts": [
                {
                    "date": "2022-07-27",
                    "week": "3",
                    "dayweather": "晴",
                    "nightweather": "晴",
                    "daytemp": "34",
                    "nighttemp": "28",
                    "daywind": "北",
                    "nightwind": "北",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2022-07-28",
                    "week": "4",
                    "dayweather": "晴",
                    "nightweather": "晴",
                    "daytemp": "34",
                    "nighttemp": "28",
                    "daywind": "北",
                    "nightwind": "北",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2022-07-29",
                    "week": "5",
                    "dayweather": "晴",
                    "nightweather": "晴",
                    "daytemp": "34",
                    "nighttemp": "28",
                    "daywind": "北",
                    "nightwind": "北",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                },
                {
                    "date": "2022-07-30",
                    "week": "6",
                    "dayweather": "晴",
                    "nightweather": "晴",
                    "daytemp": "35",
                    "nighttemp": "28",
                    "daywind": "北",
                    "nightwind": "北",
                    "daypower": "≤3",
                    "nightpower": "≤3"
                }
            ]
        }
    ]
}
```

# 获取 XML 格式返回值

> 第三个参数为返回值类型，可选 `json` 与 `xml`，默认 `json`：

```shell
$response = $weather->getWeather('深圳', 'all', 'xml');
```

## 示例：

```xml
<?xml version="1.0" encoding="UTF-8"?>
<response>
    <status>1</status>
    <count>1</count>
    <info>OK</info>
    <infocode>10000</infocode>
    <lives type="list">
        <live>
            <province>广东</province>
            <city>深圳市</city>
            <adcode>440300</adcode>
            <weather>晴</weather>
            <temperature>34</temperature>
            <winddirection>北</winddirection>
            <windpower>≤3</windpower>
            <humidity>54</humidity>
            <reporttime>2022-07-27 16:00:45</reporttime>
        </live>
    </lives>
</response>
```

# 参数说明
---
```php
array|string getWeather(string $city, string $type = 'base', string $format = 'json')
```

> `$city` - 城市名，比如：“深圳”；
> 
> `$type` - 返回内容类型：`base`: 返回实况天气 / `all`: 返回预报天气；
> 
> `$format`  - 输出的数据格式，默认为 `json` 格式，当 output 设置为 “`xml`” 时，输出的为 XML 格式的数据。

# 参考
---
> [高德开放平台天气接口](https://lbs.amap.com/api/webservice/guide/api/weatherinfo/)