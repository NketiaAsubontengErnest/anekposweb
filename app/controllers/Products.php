<?php

/**
 * Employees controller
 */
class Products extends Controller
{
    function index($id = null)
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $products = new Product();

        if (count($_POST) > 0) {
            if (isset($_POST['export'])) {
                $data = $products->query('SELECT * FROM `products` WHERE `shopid` = :shopid', ['shopid' => Auth::getShop()->shopid]);
                $filename = "products_" . date('Y-m-d') . ".csv";
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="' . $filename . '"');
                $output = fopen('php://output', 'w');
                fputcsv($output, ['Barcode', 'Product Name', 'Quantity', 'Cost Price', 'Selling Price']);
                foreach ($data as $row) {
                    fputcsv(
                        $output,
                        [
                            $row->barcode,
                            $row->pro_name,
                            $row->quantity,
                            $row->cost_price,
                            $row->selling_price
                        ]
                    );
                }
                fclose($output);
                exit;
            } elseif ($products->validate($_POST)) {

                $products->insert($_POST);

                $_SESSION['messsage'] = "Product Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {

                $_SESSION['messsage'] = "Product Not Added!";
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_headen'] = "Check Well!";
            }
        }

        if (isset($_GET['searchproduct'])) {
            $arr['searchuse'] = '%' . $_GET['searchproduct'] . '%';
            $query = "SELECT * FROM `products` WHERE `productid` LIKE :searchuse OR `barcode` LIKE :searchuse OR `pro_name` LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $products->findSearch($query, $arr);
        } else {
            $data = $products->findAll($limit, $offset, 'DESC');
        }

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Products', ''];
        $actives = 'products';
        $link = 'list';
        $hiddenSearch = "";
        return $this->view('products/index', [
            'rows' => $data,
            'hiddenSearch' => $hiddenSearch,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function add()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }
        // Setting pagination

        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $errors = [];

        $products = new Product();
        $category = new Category();

        if (count($_POST) > 0) {
            if ($products->validate($_POST)) {
                $_POST['productid'] = generateRandomCode(55);
                $_POST['shopid'] = Auth::getShop()->shopid;
                $products->insert($_POST);
                $_SESSION['messsage'] = "Product Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("products/add");
            } else {
                $errors = $products->errors;
            }
        }

        if (isset($_GET['search_box'])) {
            $arr['searchuse'] = '%' . $_GET['search_box'] . '%';
            $query = "SELECT books.*, subjects.subject, levels.class, types.booktype FROM `books` LEFT JOIN subjects ON books.subjectid = subjects.id LEFT JOIN levels ON books.classid = levels.id LEFT JOIN types ON books.typeid = types.id WHERE subjects.subject LIKE :searchuse OR levels.class LIKE :searchuse OR types.booktype LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $products->findSearch($query, $arr);
        } else {
            $data = $products->findAll($limit, $offset, 'DESC');
        }

        $catdata = $category->findAll();

        //this are for breadcrumb
        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Books', ''];
        $actives = 'add';
        $hiddenSearch = "";
        return $this->view('products/add', [
            'rows' => $data,
            'catrows' => $catdata,
            'hiddenSearch' => $hiddenSearch,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'errors' => $errors,
            'actives' => $actives
        ]);
    }

    function edit($id)
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $errors = [];

        $products = new Product();
        $category = new Category();

        if (count($_POST) > 0) {
            if ($products->validate($_POST)) {
                $products->update($id, $_POST, 'productid');
                $_SESSION['messsage'] = "Product Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("products");
            } else {
                $errors = $products->errors;
            }
        }

        $data = $products->where('productid', $id)[0];

        $catdata = $category->findAll();

        //this are for breadcrumb
        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Books', ''];
        $actives = 'add';
        $hiddenSearch = "";
        return $this->view('products/edit', [
            'row' => $data,
            'catrows' => $catdata,
            'hiddenSearch' => $hiddenSearch,
            'crumbs' => $crumbs,
            'errors' => $errors,
            'actives' => $actives
        ]);
    }

    function category()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $errors = [];

        $category = new Category();

        if (count($_POST) > 0) {
            if ($category->validate($_POST)) {
                $_POST['shopid'] = Auth::getShop()->shopid;
                $_POST['category'] = strtoupper($_POST['category']);
                $category->insert($_POST);
                $_SESSION['messsage'] = "Category Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {
                $errors = $category->errors;
                $_SESSION['messsage'] = "Category Not Added!";
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_headen'] = "Check Well!";
            }
        }

        if (isset($_GET['search_box'])) {
            $arr['searchuse'] = '%' . $_GET['search_box'] . '%';
            $query = "SELECT * FROM `categorys` WHERE `category` LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $category->findSearch($query, $arr);
        } else {
            $data = $category->findAll($limit, $offset, 'DESC');
        }

        //this are for breadcrumb
        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Category', ''];
        $actives = 'products';
        $link = 'category';
        $hiddenSearch = "";
        return $this->view('products/category', [
            'rows' => $data,
            'hiddenSearch' => $hiddenSearch,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'errors' => $errors,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function catedit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = array();
        $categorys = new Category();

        if (count($_POST) > 0) {
            $_POST['category'] = strtoupper($_POST['category']);

            $categorys->update($id, $_POST);

            $_SESSION['messsage'] = "Category Update Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect('products/category');
        }

        $data = $categorys->where('id', $id)[0];

        $actives = 'products';
        $link = 'category';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('products/catedit', [
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function update()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }
        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $products = new Product();


        if (count($_POST) > 0) {
            if ($products->validate($_POST)) {
                $products->insert($_POST);
                $_SESSION['messsage'] = "Product Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {
                $_SESSION['messsage'] = "Product Not Added!";
                $_SESSION['status_code'] = "warning";
                $_SESSION['status_headen'] = "Check Well!";
            }
        }

        if (isset($_GET['searchproduct'])) {
            $arr['searchuse'] = '%' . $_GET['searchproduct'] . '%';
            $query = "SELECT * FROM `products` WHERE `productid` LIKE :searchuse OR `barcode` LIKE :searchuse OR `pro_name` LIKE :searchuse LIMIT $limit OFFSET $offset";

            $data = $products->findSearch($query, $arr);
        } else {
            $data = $products->findAll($limit, $offset, 'DESC');
        }

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Category', ''];
        $actives = 'products';
        $link = 'updates';
        $hiddenSearch = "";
        return $this->view('products/update', [
            'rows' => $data,
            'hiddenSearch' => $hiddenSearch,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function quantupdate($id)
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }

        $products = new Product();
        $batchs = new Batch();

        if (count($_POST) > 0) {
            $arrs['shopid'] = Auth::getShop()->shopid;
            $arrs['productid'] = $id;
            $arrs['batchcode'] = $_POST['batchcode'];
            $arrs['expiredate'] = $_POST['expiredate'];
            $arrs['quantity'] = $_POST['quantity'];

            unset($_POST['batchcode']);
            unset($_POST['expiredate']);

            $batchs->insert($arrs);
            $_POST['shopid'] = $arrs['shopid'];
            $_POST['productid'] = $id;
            $query = "UPDATE `products` SET `quantity`=`quantity` + :quantity,`threshold`=:threshold WHERE `productid` =:productid AND shopid =:shopid";
            $products->query($query, $_POST);
            $_SESSION['messsage'] = "Quantity Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("products");
        }

        $data = $products->where('productid', $id)[0];

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Category', ''];
        $actives = 'products';
        $link = 'updates';
        $hiddenSearch = "";
        return $this->view('products/quantupdate', [
            'row' => $data,
            'hiddenSearch' => $hiddenSearch,
            'crumbs' => $crumbs,
            'actives' => $actives,
            'link' => $link
        ]);
    }

    function expires()
    {
        if (!Auth::logged_in()) {
            return $this->redirect('login');
        }
        // Setting pagination
        $limit = 15;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $batchs = new Batch();

        if (count($_POST) > 0) {
            $query = "UPDATE `products` SET `quantity`=`quantity` + :quantity,`threshold`=:threshold WHERE `productid` =:productid";
            //$products->query($query, $_POST);
            $_SESSION['messsage'] = "Quantity Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("products");
        }

        $data = $batchs->where_query("SELECT * FROM `batchs` WHERE `expiredate` <= CURRENT_DATE");

        $crumbs[] = ['Dashboard', 'dashboard'];
        $crumbs[] = ['Products', 'products'];
        $crumbs[] = ['Category', ''];
        $actives = 'products';
        $link = 'updates';
        $hiddenSearch = "";
        return $this->view('products/expires', [
            'rows' => $data,
            'hiddenSearch' => $hiddenSearch,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'actives' => $actives,
            'link' => $link
        ]);
    }
}
