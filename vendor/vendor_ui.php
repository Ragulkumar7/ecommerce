<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard | StyleHub UI</title>
    <style>
        :root {
            --primary-blue: #1a73e8;
            --success-green: #28a745;
            --bg-gray: #f8f9fa;
            --text-dark: #333;
        }

        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: var(--bg-gray); margin: 0; padding: 20px; color: var(--text-dark); }
        .wrapper { max-width: 1100px; margin: auto; }
        
        /* Header */
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; border-bottom: 2px solid #ddd; padding-bottom: 15px; }
        .header h1 { margin: 0; font-size: 24px; color: var(--primary-blue); }
        .logout-btn { color: #d93025; text-decoration: none; font-weight: bold; border: 1px solid #d93025; padding: 5px 15px; border-radius: 5px; transition: 0.3s; }
        .logout-btn:hover { background: #d93025; color: white; }

        /* Form Card */
        .form-card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); margin-bottom: 40px; }
        .form-card h3 { margin-top: 0; margin-bottom: 20px; color: #555; }
        
        /* Flex layout for form and preview */
        .form-content { display: flex; gap: 30px; flex-wrap: wrap; }
        .form-inputs { flex: 2; min-width: 300px; }
        .image-preview-box { 
            flex: 1; min-width: 250px; border: 2px dashed #ccc; border-radius: 12px; 
            display: flex; flex-direction: column; align-items: center; justify-content: center; 
            background: #fafafa; padding: 15px; position: relative;
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px; }
        
        input[type="text"], input[type="number"], select, textarea { 
            width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; box-sizing: border-box; font-size: 14px;
        }
        
        /* Image Preview Style */
        #img-preview { max-width: 100%; max-height: 250px; border-radius: 8px; display: none; }
        .preview-text { color: #999; font-size: 14px; text-align: center; }

        .checkbox-row { display: flex; align-items: center; gap: 10px; margin: 15px 0; font-weight: 500; }
        .checkbox-row input { width: 18px; height: 18px; cursor: pointer; }

        .btn-upload { 
            background: var(--success-green); color: white; border: none; padding: 14px 30px; 
            border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px; width: 100%; transition: 0.3s;
        }
        .btn-upload:hover { background: #218838; transform: translateY(-1px); }

        /* Product Grid */
        h2 { margin-bottom: 20px; border-left: 5px solid var(--primary-blue); padding-left: 15px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
        
        .product-item { 
            background: white; border-radius: 10px; overflow: hidden; border: 1px solid #eee; 
            transition: 0.3s; text-align: center; padding-bottom: 15px;
        }
        .product-item img { width: 100%; height: 180px; object-fit: cover; background: #eee; }
        .product-info { padding: 10px; }
        .price-tag { font-weight: bold; color: var(--primary-blue); font-size: 18px; margin: 5px 0; }
        
        .badge { font-size: 12px; padding: 4px 10px; border-radius: 20px; font-weight: bold; display: inline-block; margin-top: 5px; }
        .global { background: #e8f5e9; color: #2e7d32; }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="header">
        <h1>StyleHub Vendor Dashboard</h1>
        <a href="#" class="logout-btn">Logout</a>
    </div>

    <div class="form-card">
        <h3>Share New Product to Global Sales</h3>
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="form-content">
                <div class="form-inputs">
                    <div class="form-row">
                        <div>
                            <label>Product Name</label>
                            <input type="text" placeholder="e.g. Banarasi Silk Saree">
                        </div>
                        <div>
                            <label>Category</label>
                            <select>
                                <option>Sarees</option>
                                <option>Salwar Kameez</option>
                                <option>Lehengas</option>
                                <option>Men's Ethnic Wear</option>
                                <option>Laptops & PCs</option>
                                <option>Smartphones</option>
                                <option>Electronics Accessories</option>
                                <option>Jewelry</option>
                                <option>Handicrafts</option>
                                <option>Home Decor</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div>
                            <label>Price (₹ Rupees)</label>
                            <input type="number" placeholder="0.00">
                        </div>
                        <div>
                            <label>Product Image</label>
                            <input type="file" id="product_image_input" accept="image/*">
                        </div>
                    </div>

                    <label>Description</label>
                    <textarea rows="4" placeholder="Detail the material, quality, origin, and specifications..."></textarea>
                    
                    <div class="checkbox-row">
                        <input type="checkbox" id="global_check" checked>
                        <label for="global_check">Publish to Global Directory</label>
                    </div>
                </div>

                <div class="image-preview-box">
                    <span class="preview-text" id="preview-placeholder">Live Image Preview</span>
                    <img id="img-preview" src="" alt="Preview">
                </div>
            </div>

            <button type="button" class="btn-upload">Publish Product</button>
        </form>
    </div>

    <h2>Your Inventory Preview</h2>
    <div class="product-grid">
        <div class="product-item">
            <img src="https://via.placeholder.com/200x180?text=Saree+Example" alt="Product">
            <div class="product-info">
                <h4>Premium Kanchipuram</h4>
                <div class="price-tag">₹ 8,500.00</div>
                <span class="badge global">Global Ready</span>
            </div>
        </div>
    </div>
</div>

<script>
    // Live Image Preview Logic
    const imageInput = document.getElementById('product_image_input');
    const imagePreview = document.getElementById('img-preview');
    const placeholder = document.getElementById('preview-placeholder');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            placeholder.style.display = "none";
            imagePreview.style.display = "block";
            
            reader.addEventListener('load', function() {
                imagePreview.setAttribute('src', this.result);
            });
            reader.readAsDataURL(file);
        } else {
            placeholder.style.display = "block";
            imagePreview.style.display = "none";
            imagePreview.setAttribute('src', '');
        }
    });
</script>

</body>
</html>