@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"></script>
    <!-- Tags Input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script>
        $("#input-tags").selectize({
            delimiter: ",",
            persist: false,
            create: function(input) {
                return {
                    value: input,
                    text: input,
                };
            },
        });
    </script>
    <script src="{{ asset('assets') }}/js/plugins/ckeditor5-classic/build/ckeditor.js"></script>
    <script>
        One.helpersOnLoad(['js-ckeditor5']);
    </script>

    <script>
        function toggleLabel() {
            var checkbox = document.getElementById("product_visibility");
            var label = document.getElementById("visibility_label");

            if (checkbox.checked) {
                label.textContent = "On";
            } else {
                label.textContent = "Off";
            }
        }

        $(document).ready(function () {
    // Function to create a variant option row dynamically
    function getVariantOptionTemplate(options = "") {
        return `
        <div class="row variant-option border border-gray-300 p-2 mx-2 mb-3 d-flex align-items-center justify-content-between">
            <div class="col-lg-3 col-4">
                <div class="mb-4">
                    <label class="form-label" for="one-ecom-attribute">Attribute</label>
                    <select name="attribute_id[]" class="form-select" required>
                        <option value="">Select Attribute</option>
                        ${options} <!-- Dynamically inject options -->
                    </select>
                </div>
            </div>

            <div class="col-lg-3 col-4">
                <div class="mb-4">
                    <label class="form-label" for="color">Color</label>
                    <select name="color_id[]" class="form-select" id="color" required>
                        <option value="">Select Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-2 col-4">
                <div class="mb-4">
                    <label class="form-label" for="one-ecom-extra-price">Current Price</label>
                    <div class="d-flex">
                        <input type="number" class="form-control" name="current_price[]" placeholder="Current price" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="mb-4">
                    <label class="form-label" for="one-ecom-extra-price">Regular Price</label>
                    <div class="d-flex">
                        <input type="number" class="form-control" name="regular_price[]" placeholder="Regular price" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-6">
                <div class="mb-4">
                    <label class="form-label" for="one-ecom-extra-price">Quantity (Stock)</label>
                    <div class="d-flex">
                        <input type="number" class="form-control" name="quantity[]" placeholder="Quantity" required>
                        <button class="btn btn-danger ms-2 remove-option" type="button"><i class="fa fa-x"></i></button>
                    </div>
                </div>
            </div>
        </div>
        `;
    }

    let optionsHtml = ""; // To store attribute options globally

    // Fetch attributes on category selection
    $("#category").on("change", function () {
        const categoryId = $(this).val();

        if (categoryId) {
            $.ajax({
                url: `/attribute/get-attributes/${categoryId}`,
                method: "GET",
                success: function (response) {
                    console.log("Attributes Response:", response); // Debugging

                    // Generate the attribute options
                    optionsHtml = response
                        .map(attr => `<option value="${attr.id}">${attr.name}</option>`)
                        .join("");

                    // Update all existing variant select fields
                    $(".variant-options-container .variant-option select[name='attribute_id[]']").each(function () {
                        $(this).html(`<option value="">Select Attribute</option>${optionsHtml}`);
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching attributes:", error);
                    alert("Could not fetch attributes. Please try again.");
                },
            });
        }
    });

    // Add More Variant Button Click
    $("#add-more-option").on("click", function () {
        if (optionsHtml === "") {
            showToast("Please select a category first to load attributes.", "error");
            return;
        }

        // Append a new variant row
        $(".variant-options-container").append(getVariantOptionTemplate(optionsHtml));
    });

    // Remove a variant row
    $(document).on("click", ".remove-option", function () {
        if ($(".variant-options-container .variant-option").length > 1) {
            $(this).closest(".variant-option").remove();
        }
    });
});


    </script>

    <script>
        $(document).ready(function() {
            $('input[data-role="tagsinput"]').tagsinput({
                // Additional options here
            });
        });
    </script>

    <script>
        document.getElementById('cover-input').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;

                    // Remove previous image (if any) and add new one
                    const coverUpload = document.querySelector('.cover-upload');
                    const existingImg = coverUpload.querySelector('img');
                    if (existingImg) {
                        coverUpload.removeChild(existingImg);
                    }
                    coverUpload.appendChild(img);

                    // Hide the text after image is uploaded
                    document.querySelector('.upload-text').style.display = 'none';
                };

                reader.readAsDataURL(file);


            }
        });
    </script>



    <script>
        jQuery(document).ready(function() {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();
                                reader.onload = function(e) {
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#meta_toggle').change(function() {
                if ($(this).is(':checked')) {
                    $('#meta').slideDown();
                } else {
                    $('#meta').slideUp();
                }
            });
        });
    </script>
@endpush
