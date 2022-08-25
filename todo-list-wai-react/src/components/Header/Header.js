import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import { Link } from 'react-router-dom'
import './Header.css'

const  Header = () => {
  return (
    <Navbar bg="light" expand="lg">
      <Container bg="light">
        <Navbar.Brand>Todo List wia React js 18</Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
          <Nav className="me-auto">
            <Link to="/" className='nav-link'>Show TodoList  </Link>
            <Link to="/new" className='nav-link'>Add new Todo List</Link>
          </Nav>
        </Navbar.Collapse>
      </Container>
    </Navbar>
  );
}

export default Header ;