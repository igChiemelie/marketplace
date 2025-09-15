@extends('layouts.admin')
@section('content')
<!-- CMS Tab -->
<div class="" id="cms">
    <div class="page-title">
        <h1>Content Management System</h1>
        <button class="btn btn-primary"><i class="fas fa-plus"></i> New Page</button>
    </div>

    <div class="tabs">
        <div class="tab active" data-cms-tab="pages">Pages</div>
        <div class="tab" data-cms-tab="posts">Blog Posts</div>
        <div class="tab" data-cms-tab="media">Media Library</div>
        <div class="tab" data-cms-tab="menus">Menus</div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>All Pages</h2>
            <div class="action-buttons">
                <button class="btn btn-sm btn-primary">Export</button>
                <button class="btn btn-sm btn-success">Filter</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Last Modified</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Homepage</td>
                            <td>Admin User</td>
                            <td><span class="badge badge-success">Published</span></td>
                            <td>Oct 15, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>About Us</td>
                            <td>Admin User</td>
                            <td><span class="badge badge-success">Published</span></td>
                            <td>Oct 10, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Services</td>
                            <td>Sarah Johnson</td>
                            <td><span class="badge badge-warning">Draft</span></td>
                            <td>Oct 14, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>Admin User</td>
                            <td><span class="badge badge-success">Published</span></td>
                            <td>Oct 5, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Edit Page Content</h2>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="page-title">Page Title</label>
                    <input type="text" class="form-control" id="page-title" value="Homepage">
                </div>
                <div class="form-group">
                    <label for="page-slug">URL Slug</label>
                    <input type="text" class="form-control" id="page-slug" value="home">
                </div>
                <div class="form-group">
                    <label for="page-content">Content</label>
                    <div class="editor-toolbar">
                        <button type="button"><i class="fas fa-bold"></i></button>
                        <button type="button"><i class="fas fa-italic"></i></button>
                        <button type="button"><i class="fas fa-underline"></i></button>
                        <button type="button"><i class="fas fa-list-ul"></i></button>
                        <button type="button"><i class="fas fa-list-ol"></i></button>
                        <button type="button"><i class="fas fa-link"></i></button>
                        <button type="button"><i class="fas fa-image"></i></button>
                    </div>
                    <div class="editor-content" id="page-content" contenteditable="true">
                        <h2>Welcome to our website</h2>
                        <p>This is the homepage content. You can edit it using the toolbar above.</p>
                        <p>Add your content here...</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="page-status">Status</label>
                    <select class="form-control" id="page-status">
                        <option>Published</option>
                        <option>Draft</option>
                        <option>Pending Review</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update Page</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Media Library</h2>
        </div>
        <div class="card-body">
            <div class="file-upload">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Drag & drop files here or click to upload</p>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>File Name</th>
                            <th>Type</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-image" style="color: #7A16BB;"></i></td>
                            <td>header-image.jpg</td>
                            <td>Image</td>
                            <td>Oct 15, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-file-pdf" style="color: #f72585;"></i></td>
                            <td>document.pdf</td>
                            <td>PDF</td>
                            <td>Oct 14, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-video" style="color: #4cc9f0;"></i></td>
                            <td>promo-video.mp4</td>
                            <td>Video</td>
                            <td>Oct 10, 2023</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-download"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection