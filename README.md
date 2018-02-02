Flamework
--
_Set you project ablaze!_

- [Layout rules](#LAYOUT)
- [Building](#Building)
- [Mixins](#Mixins)
___
## LAYOUT

```html

<!-- Direction -->
<element layout="column" nowrap>...</element>
<element mobile-layout="row">...</element>


<!-- Alignment -->
<element align="center stretch">...</element>
<element mobile-align="center center">...</element>

<!--
Align Options:
    Main Axis:
        - start
        - center
        - end
        - between
        - around

    Cross Axis:
        - start
        - center
        - end
        - stretch
-->


<!-- Flex Columns -->
<element flex="33">...</element>
<element mobile-flex="grow">...</element>

<!--
Flex Options:
    - multiples of 5: 5, 10, .. 95, 100
    - 33 or 66

    Behavior:
        - grow
        - initial
        - auto
        - none
-->
```

___

## Building
Run `npm install`
to serve and build `npm start` ou `npm run hot` for Hot Module Replacement;

___
## Mixins
```scss
@include shadow;
@include transition;
@include icon-small; //based on $radius(6pt)
```
---
## Vars
```scss
$grid-gutter: 1rem !default;
$container-width: 73em;
$grid-sm: "screen and (max-width: 50em)" !default; // ~768px
$grid-lg: "screen and (min-width: 50.01em)" !default;
// variables
$black8: rgba(0, 0, 0, .7);
$black5: rgba(0, 0, 0, .5);
$black3: rgba(0, 0, 0, .25);
$white7: rgba(255, 255, 255, .75);
$white5: rgba(255, 255, 255, .5);
$white3: rgba(255, 255, 255, .3);
$background: #e0e0e0;
$radius: 6pt;
//Color pallete of fire !!
$color-1: #DAF7A6;
$color-2: #FFC300;
$color-3: #FF5733;
$color-4: #C70039;
$color-5: #900C3F;
$color-6: #581845;
```
