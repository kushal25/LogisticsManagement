package edu.sjsu.CMPE281.ServerComponent;

import org.json.JSONException;
import org.json.JSONObject;

import edu.sjsu.CMPE281.SupplyChainComponent;
import edu.sjsu.CMPE281.Nodes.ControlNode;
import edu.sjsu.CMPE281.Nodes.Sensor;
import edu.sjsu.CMPE281.Nodes.SensorNode;

public class Transmitter
{
	private long timer = 0;
	private long transmitUpdateInterval = 1000;
	private boolean isInitialized = false;

	public void init()
	{
		if (isInitialized)
		{
			return;
		}
		isInitialized = true;
		// control node status
		ControlNode[] controlNodes = SupplyChainComponent.getComponent().getControlNodes();

		JSONObject controlNodeStatus = new JSONObject();
		JSONObject sensorNodeStatus = new JSONObject();
		JSONObject sensorStatus = new JSONObject();

		int noOfControlNodes = 0;
		int noOfSensorNodes = 0;
		int noOfSensors = 0;

		try
		{
			for (int i = 0; i < controlNodes.length; i++)
			{
				String json = controlNodeStatus.toString();
				if (json.contains(controlNodes[i].getContolNodeId()))
				{
					continue;
				}
				controlNodeStatus.put("CNStatus-" + noOfControlNodes++, controlNodes[i].getContolNodeId());
				controlNodeStatus.put(controlNodes[i].getContolNodeId(), 1);

				SensorNode[] sensorNodes = controlNodes[i].getSensorNodes();
				for (int sIndex = 0; sIndex < sensorNodes.length; sIndex++)
				{
					SensorNode sensorNode = sensorNodes[sIndex];
					json = sensorNodeStatus.toString();
					if (json.contains(sensorNode.getSensorNodeId()))
					{
						continue;
					}
					sensorNodeStatus.put("SNStatus-" + noOfSensorNodes++, sensorNode.getSensorNodeId());
					sensorNodeStatus.put(sensorNode.getSensorNodeId(), 1);

					Sensor[] sensors = sensorNode.getSensors();
					for (int index = 0; index < sensors.length; index++)
					{
						Sensor sensor = sensors[index];
						json = sensorStatus.toString();
						if (json.contains(sensor.getSensorId()))
						{
							continue;
						}
						sensorStatus.put("SStatus-" + noOfSensors++, sensor.getSensorId());
						sensorStatus.put(sensor.getSensorId(), 1);
					}
				}
			}

			// set count
			controlNodeStatus.put("NO-OF-CNS", controlNodes.length);
			sensorNodeStatus.put("NO-OF-SENSOR-NODES", noOfSensorNodes);
			sensorStatus.put("NO-OF-SENSORS", noOfSensors);
		} catch (Exception e)
		{
		}

		// control node status
		String url = ServerComponentConstants.SERVER_URL + "ControlNodeStatusServlet";
		String response = ConnectionUtility.transmitData(url, controlNodeStatus);
		System.out.println(response);

		// sensor node status
		url = ServerComponentConstants.SERVER_URL + "SensorNodeStatusServlet";
		response = ConnectionUtility.transmitData(url, sensorNodeStatus);
		System.out.println(response);

		// save sensors
		url = ServerComponentConstants.SERVER_URL + "SensorStatusServlet";
		response = ConnectionUtility.transmitData(url, sensorStatus);
		System.out.println(response);
	}

	/*
	 * transmit information to server
	 */
	public void update(long time)
	{
		if (true)
			return;
		timer += time;
		if ((timer - transmitUpdateInterval) >= 0)
		{
			timer = time;

			JSONObject sensorData = generateJSONData();

			// Or in Java 7 and later, use the constant: java.nio.charset.StandardCharsets.UTF_8.name()
			String charset = "UTF-8";

			String url = ServerComponentConstants.SERVER_URL + "SensorInformationServlet";
			String response = ConnectionUtility.transmitData(url, sensorData);

			System.out.println(response);
		}
	}

	/*
	 * generate JSON data using sensor data
	 */
	private JSONObject generateJSONData()
	{
		// generate JSON data
		JSONObject sensorData = new JSONObject();

		int totalNoOfSensors = -1;
		ControlNode[] controlNodes = SupplyChainComponent.getComponent().getControlNodes();
		if (controlNodes != null)
		{
			for (int cIndex = 0; cIndex < controlNodes.length; cIndex++)
			{
				ControlNode controlNode = controlNodes[cIndex];
				SensorNode[] sensorNodes = controlNode.getSensorNodes();
				for (int sIndex = 0; sIndex < sensorNodes.length; sIndex++)
				{
					SensorNode sensorNode = sensorNodes[sIndex];
					Sensor[] sensors = sensorNode.getSensors();
					for (int index = 0; index < sensors.length; index++)
					{
						Sensor sensor = sensors[index];

						JSONObject obj = new JSONObject();
						try
						{
							totalNoOfSensors++;
							// control node info
							obj.put("ControlNodeId", controlNode.getContolNodeId());
							obj.put("truckId", controlNode.getTruckId());

							// sensor node info
							obj.put("SensorNodeId", sensorNode.getSensorNodeId());

							// sensor info
							obj.put("SensorId", sensor.getSensorId());
							obj.put("SensorType", sensor.getSensorType());
							obj.put("SensorData", sensor.getSensorData());
							obj.put("Timestamp", sensor.getTimeStamp());

							sensorData.put("Sensor-" + totalNoOfSensors, obj);
						} catch (Exception e)
						{
						}
					}
				}
			}
		}

		try
		{
			sensorData.put("NO-OF-SENSORS", totalNoOfSensors);
		} catch (JSONException e)
		{
			e.printStackTrace();
		}

		return sensorData;
	}
}
// JSONObject temp = new JSONObjectIgnoreDuplicates(controlNodeStatus.toString());
// if( ((JSONObjectIgnoreDuplicates)temp).isDuplicateExists)