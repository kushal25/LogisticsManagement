package com.sjsu.CMPE281;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.json.JSONObject;

/**
 * Servlet implementation class SensorNodeStatusServlet
 */
@WebServlet("/SensorNodeStatusServlet")
public class SensorNodeStatusServlet extends HttpServlet
{
	private static final long serialVersionUID = 1L;

	/**
	 * @see HttpServlet#HttpServlet()
	 */
	public SensorNodeStatusServlet()
	{
		super();
	}

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException
	{
		doPost(request, response);
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse
	 *      response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException
	{
		response.setContentType("text/html");
		PrintWriter out = response.getWriter();
		try
		{
			String jsonString = request.getParameter("req");
			out.println(jsonString);
			JSONObject json = new JSONObject(jsonString);
			int noOfSensorNodes = json.getInt("NO-OF-SENSOR-NODES");
			out.println("SensorNode-- noOfSensorNodes" + noOfSensorNodes);
			// establish connection
			Class.forName("com.mysql.jdbc.Driver");
			Connection con = (Connection) DriverManager.getConnection("jdbc:mysql://mysql-instance1.cfa3qxsmwzic.us-west-1.rds.amazonaws.com:3306/cmpe281", "cmpe281", "admin123");
			out.println("Trying to establish connection...");
			for (int index = 0; index < noOfSensorNodes; index++)
			{
				String sensorNodeId = json.getString("SNStatus-" + index);
				int enabled = json.getInt(sensorNodeId);
				
				out.println("SensorNode-- sensorNodeId:: " + sensorNodeId + ", enabled:: " + enabled);
				// save to db
				if (!con.isClosed())
				{
					PreparedStatement ps = ((java.sql.Connection) con).prepareStatement("INSERT INTO SENSOR_NODE_STATUS(SENSOR_NODE_ID, SENSOR_NODE_STATUS) VALUES (?,?)");
					ps.setString(1, sensorNodeId);
					ps.setInt(2, enabled);
					ps.execute();
				}
			}
		} catch (Exception e)
		{
			out.println(e);
		}
	}
}