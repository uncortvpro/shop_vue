{!! $delimeter_start??'' !!}
@foreach($category_variations as $variation)

    <p >{{$variation->title??''}}

        <a href="#" data-category-id="{{$category->id}}" data-variation-id="{{$variation->id}}" id="link_to_modal_create" data-bs-toggle="modal" data-bs-target="#addVariationModal">
            Add subvariation
        </a>
        |

        <a href="#" data-category-id="{{$category->id}}" data-variation-id="{{$variation->id}}" id="link_to_modal_update"  data-bs-toggle="modal" data-bs-target="#updateVariationModal">
            Update
        </a>
        |
        <a href="/category/variation/delete/{{$category->id}}/{{$variation->id}}" >
            Delete
        </a>
        </p>
    @isset($variation->children)
        @include('category.templates.variation_list',[
            'category_variations' => $variation->children,
            'delimeter_start' => '<div style="margin-left:15px">',
            'delimeter_end' => '</div>'
            ])
    @endisset
@endforeach
{!! $delimeter_end ?? '' !!}
